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

    /**
     * Core functions
     */

    private static function store($file,$pathOfServer)
    {
        $uniqueFileName = uniqid().'_'.$file->getClientOriginalName();
        $stored =  self::defaultDisk()->put($pathOfServer."\\".$uniqueFileName,  File::get($file));
        $result = [
            'stored' => $stored,
            'unique_file_name'=>$uniqueFileName
        ];
        return $result;
    }

    private static function remove($fileName,$pathOfServer)
    {
        $removed = self::defaultDisk()->delete($pathOfServer."\\".$fileName);
        return $removed;
    }
    private  static function exists($fileName,$pathOfServer)
    {
        $exists = self::defaultDisk()->exists($pathOfServer.'\\'.$fileName);
        return $exists;
    }

    /**
     * Specifics functions
     */

    public static function storeModel($file){
        return self::store($file,self::MODELS_ROOT_DIR);
    }

    public static function removeModel($fileName){
        return self::remove($fileName,self::MODELS_ROOT_DIR);
    }

    public static function existsModel($fileName){
        return self::exists($fileName,self::MODELS_ROOT_DIR);
    }


}
