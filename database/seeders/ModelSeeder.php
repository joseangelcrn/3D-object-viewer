<?php

namespace Database\Seeders;

use App\Models\Model3D;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $user = User::first();
        //
        $amount = 10;
        for ($i=0; $i < $amount; $i++) {
            $user->models()->create([
                'title'=>$faker->text(20),
                'description'=>$faker->text(20),
                'file_name'=>$faker->text(5),
                'file_size'=>$faker->numberBetween(100,1000),
                'file_extension'=>$faker->fileExtension,
            ]);
        }
    }
}
