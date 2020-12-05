<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'root_dir'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relations
     */

     public function models()
     {
        return $this->hasMany(Model3D::class);
     }

     /**
      * Functions
      */

    /**
     * Create model3d (binary file and data of database)
     */

      public function createModel3d($title,$description,$file)
      {
        $fileInfo = CustomFile::storeModel($file,$this->root_dir);
        $created = false;

        if ($fileInfo['stored']) {
            $created =  $this->models()->create([
                'title'=>$title,
                'description'=>$description,
                'file_name'=>$fileInfo['unique_file_name'],
                'file_size'=>$fileInfo['file_size'],
                'file_extension'=>$fileInfo['file_extension'],
            ]);
        }

        return $created;
      }

      /**
       * Update model3d (bin and bd)
       */

       public function updateModel3d($idModel,$title,$description,$file = null)
       {
            $model = $this->models()->findOrFail($idModel);
            $updated = false;

           //there is a new file to upload
            if ($file != null) {
                $deletedFile = CustomFile::removeModel($model->file_name,$this->root_dir);
                $result = CustomFile::storeModel($file,$this->root_dir);

                if ($result['stored'] and $deletedFile) {
                    $model->update([
                        'title'=>$title,
                        'description'=>$description,
                        'file_name'=>$result['unique_file_name']
                    ]);
                    $updated= true;
                }
            }
            else{
                $model->update([
                    'title'=>$title,
                    'description'=>$description
                ]);
                $updated= true;
            }

            return $updated;
       }

      /**
       * Delete model3d (binary file and data of database)
       */

      public function deleteModel3d($id)
      {
        $deleted = false;
        $fileDeleted = false;
        $fileExists = true;

        $model = $this->models()->findOrFail($id);
        $fileExists = CustomFile::existsModel($model->file_name,$this->root_dir);

        //found file so is going to delete it
        if ($fileExists) {
            $fileDeleted = CustomFile::removeModel($model->file_name,$this->root_dir);
        }
        //if file doesnt exists or file is already deleted then delete model of database
        if ($fileDeleted or !$fileExists) {
            $deleted = $model->delete();
        }

        return $deleted;
      }
}
