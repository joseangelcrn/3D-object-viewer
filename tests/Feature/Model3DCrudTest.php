<?php

namespace Tests\Feature;

use App\Models\CustomFile;
use App\Models\Model3D;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

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

        //Check if file exist

        $pathFile = '';
        CustomFile::exists($pathFile);

        //Remove test file

    }
}
