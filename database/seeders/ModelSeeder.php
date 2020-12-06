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
        $user = User::first();
        //
        $amount = 5;
        Model3D::factory()->count($amount)->create();

    }
}
