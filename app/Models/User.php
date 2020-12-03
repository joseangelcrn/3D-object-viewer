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

      public function createModel3d($title,$description,$uniqueFileName)
      {
        return $this->models()->create([
            'title'=>$title,
            'description'=>$description,
            'file_name'=>$uniqueFileName
        ]);
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
        $fileExists = CustomFile::existsModel($model->file_name);

        //found file so is going to delete it
        if ($fileExists) {
            $fileDeleted = CustomFile::removeModel($model->file_name);
        }
        //if file doesnt exists or file is already deleted then delete model of database
        if ($fileDeleted or !$fileExists) {
            $deleted = $model->delete();
        }

        return $deleted;
      }
}
