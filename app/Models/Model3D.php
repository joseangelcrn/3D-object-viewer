<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Model3D extends Model
{
    use HasFactory;

    protected $table = 'models_3d';


    protected $fillable = [
        'title',
        'description',
        'file_name',
        'file_size',
        'file_extension'
    ];

    /**
     * Relations
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Functions
     */

}
