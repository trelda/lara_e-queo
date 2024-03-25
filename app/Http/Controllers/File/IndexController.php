<?php

namespace App\Http\Controllers\File;

use App\Models\File;
use App\Http\Requests\File\IndexRequest;

class IndexController extends BaseController
{
    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated();

        $files = File::orderBy('id', 'desc')->paginate(10);
        
        return view('file.index', compact('files'));
    }
}
