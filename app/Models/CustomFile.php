<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CustomFile
{

    public const  MODELS_ROOT_DIR = 'models3D';


    public static function defaultDisk()
    {
        return Storage::disk('public');
    }


    public static function store($file,$test = false){
        $uniqueFileName = uniqid().'_'.$file->getClientOriginalName();
        $stored =  self::defaultDisk()->put(self::MODELS_ROOT_DIR."\\".$uniqueFileName,  File::get($file));
        $result = [
            'stored' => $stored,
            'unique_file_name'=>$uniqueFileName
        ];
        return $result;
    }

    public static function remove(string  $filename)
    {
        $removed = self::defaultDisk()->delete(self::MODELS_ROOT_DIR."\\".$filename);

        return $removed;
    }

    public static function exists(string $path)
    {
        $exists = self::defaultDisk()->exists($path);
        return $exists;
    }
}
