<?php

namespace App\Http\Controllers\File;

use App\Models\User;

class UploadController extends BaseController
{

    public function __invoke() {
        $user = User::find(Auth()->user()->id);
        return view('file.upload', compact('user'));
    }

}