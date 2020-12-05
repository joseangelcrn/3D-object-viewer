<?php

namespace Tests\Feature;

use App\Models\CustomFile;
use App\Models\Model3D;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Model3DCrudTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('test-model-3d.obj', 100);

        Auth::login($user);

        $data = [
            'title'=>'title test',
            'description'=>'description test',
            'file'=>$file
        ];

        $response = $this->post('/model',$data);

        $response->assertStatus(200);


        $exist  = CustomFile::existsModel('',$user->root_dir);

        $this->assertTrue($exist);

        //Test is finished, now I must to delete uploaded file

        $removedDirectory =  CustomFile::deleteUserDirectory($user->root_dir);

        $this->assertTrue($removedDirectory);
    }

    // public function testDelete()
    // {
    //     $response = $this->delete('/model',$this->model->id);

    //     $this->assertStatus(200);
    // }
}

