<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;

class StoreController extends BaseController
{
    public function __invoke(Request $request) {
        if ($request->isMethod('post')) {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $userId = Auth()->user()->id;
                $saveResult = $this->service->store([
                    'file' => $file,
                    'userId' => $userId
                ]);
                if ($saveResult !== false) {
                    $this->service->uploadToS3(public_path() . '/uploaded/'. $saveResult);
                    return redirect()->route('file.index');
                } else {
                    return redirect()->route('home');
                }
            }
        }
    }
}