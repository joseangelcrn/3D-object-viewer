<?php

namespace Tests\Feature;

use App\Models\CustomFile;
use App\Models\Model3D;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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

    public function testShow()
    {
        $user = User::factory()->create();

        Auth::login($user);

        //Create 3d model and attach to current fake user
        $model = Model3D::factory()->make();
        $model->user_id = $user->id;
        $model->save();

        $response = $this->get('/model/'.$model->id);

        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('test-model-3d-updated.obj', 100);

        Auth::login($user);

        //Create 3d model and attach to current fake user
        $model = Model3D::factory()->make();
        $model->user_id = $user->id;
        $model->save();

        //simulating update..
        $updatedModel = Model3D::factory()->make();
        $updatedModel->id = $model->id;

        //attaching file to model for confort.
        $updatedModel->file = $file;

        $response = $this->put('/model/'.$updatedModel->id,$updatedModel->toArray());

        $response->assertStatus(200);

        //Test is finished, now I must to delete uploaded file

        $removedDirectory =  CustomFile::deleteUserDirectory($user->root_dir);
        
        $this->assertTrue($removedDirectory);

    }

    public function testDelete()
    {
        $this->withoutMiddleware();
        //make user and login
        $user = User::factory()->create();

        Auth::login($user);

        //Create 3d model and attach to current fake user
        $model = Model3D::factory()->make();
        $model->user_id = $user->id;
        $model->save();

        $response = $this->delete('/model/'.$model->id,$model->toArray());

        $response->assertStatus(200);
    }
}

