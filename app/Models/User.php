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

      public function createModel3d($title,$description,$uniqueFileName)
      {
        return $this->models()->create([
            'title'=>$title,
            'description'=>$description,
            'file_name'=>$uniqueFileName
        ]);
      }

      public function deleteModel3d($id)
      {
        $deleted = false;
        $fileDeleted = false;
        $dataDeleted = false;

        $model = $this->models()->findOrFail($id);


        //bin part
        $fileDeleted = CustomFile::remove($model->file_name);


        //bd part

        if ($fileDeleted) {
            $dataDeleted = $model->delete();
        }
        else if ($fileDeleted and $dataDeleted) {
            $deleted = true;
        }

        return $deleted;
      }
}
