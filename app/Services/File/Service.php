<?php

namespace App\Services\File;
use App\Models\File;

use App\Models\User;
use Aws\S3\S3Client;
use Aws\S3\ObjectUploader;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;

class Service {

    public function store($data) {
        if ((($data['file']->clientExtension()) !== 'pdf') || ($data['file']->getClientMimeType() !== 'application/pdf')) {
            return false;
        }
        $fileName = '/uploaded/'.$data['userId'].'_'.$data['file']->getClientOriginalName();
        $fileName = pathinfo($fileName, PATHINFO_FILENAME);
        
        $appendName = '';
        $iteration = 1;

        while (file_exists(public_path() . '/uploaded/'.$fileName.$appendName.'.pdf') === true) {
            $appendName = ($iteration > 0) ? '_'.$iteration : '' ;
            $iteration++;
        }
        $fileName = $fileName.$appendName.'.pdf';

        if ($data['file']->move(public_path() . '/uploaded', $fileName)) {
            $fileData = [
                'name' => $fileName,
                'user_id' => $data['userId']
            ];
            File::create($fileData);
            return $fileName;
        }
    }

    public function uploadToS3($fileName) {

        $s3 = new S3Client([
            'version' 	=> 'latest',
            'region'  	=> 'ru-msk',
            'use_path_style_endpoint' => true,
            'credentials' => [
                'key'	=> User::access_key(),
                'secret' => User::secret_key(),
            ],
            'endpoint' => 'https://hb.ru-msk.vkcs.cloud'
        ]);

        $source = fopen($fileName, 'rb');
        $uploader = new ObjectUploader(
            $s3,
            'e-queo',
            basename($fileName),
            $source
        );

        $file = File::where('name', basename($fileName))
            ->where('user_id', Auth()->user()->id)
            ->first();

        do {
            try {
                $result = $uploader->upload();
                if ($result["@metadata"]["statusCode"] == '200') {
                    $file->update(['status'=>'uploaded to S3']);
                } else {
                    $file->update(['status'=>'uploading error']);
                }
            } catch (MultipartUploadException $e) {
                rewind($source);
                $uploader = new MultipartUploader($s3, $source, [
                    'state' => $e->getState(),
                ]);
            }
        } while (!isset($result));

        fclose($source);
    }
}