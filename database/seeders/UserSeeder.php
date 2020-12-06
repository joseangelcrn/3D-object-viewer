<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Main user
        User::create([
            'name'=>'jose angel',
            'email'=>'jose@gmail.com',
            'password'=>bcrypt('josejose'),
            'root_dir'=> substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9)

        ]);

       $amount = 3;
       User::factory()->count($amount)->create();
    }
}
