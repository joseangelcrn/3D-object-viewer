<?php

namespace Database\Factories;

use App\Models\Model3D;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class Model3DFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model3D::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userId = User::first()->id;
        return [
            'title' => $this->faker->text(15),
            'description' => $this->faker->text(),
            'file_name' => $this->faker->text(10),
            'file_size' => $this->faker->numberBetween(100,1000),
            'file_extension' => $this->faker->fileExtension,
            'user_id'=> $userId
        ];
    }
}
