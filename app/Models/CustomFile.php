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

     private static function setHashFileName($file)
     {
        $uniqueFileName = uniqid().'_'.$file->getClientOriginalName();
        $uniqueFileName = str_replace(' ','_',$uniqueFileName); //replace 'spaces' with '_'
        return $uniqueFileName;
     }

    private static function store($file,$pathOfServer)
    {
        $uniqueFileName = self::setHashFileName($file);
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();

        $stored =  self::defaultDisk()->put($pathOfServer."\\".$uniqueFileName,  File::get($file));
        $result = [
            'stored' => $stored,
            'unique_file_name'=>$uniqueFileName,
            'file_extension'=>$extension,
            'file_size'=>$size,
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

    public static function storeModel($file,$subDir){
        return self::store($file,self::MODELS_ROOT_DIR.'\\'.$subDir.'\\');
    }

    public static function removeModel($fileName,$subDir){
        return self::remove($fileName,self::MODELS_ROOT_DIR.'\\'.$subDir.'\\');
    }

    public static function existsModel($fileName,$subDir){
        return self::exists($fileName,self::MODELS_ROOT_DIR.'\\'.$subDir.'\\');
    }


}
