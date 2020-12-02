<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CustomFile
{
    public static function store($file){
        $uniqueFileName = uniqid().'_'.$file->getClientOriginalName();
        $stored =  Storage::disk('public')->put("objects3d\\".$uniqueFileName,  File::get($file));
        $result = [
            'stored' => $stored,
            'unique_file_name'=>$uniqueFileName
        ];
        return $result;
    }
}
