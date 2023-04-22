<?php

namespace Database\Factories;

use App\Models\UsersModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersFactory extends Factory
{

    protected $model = UsersModel::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_fullname' => $this->faker->name(),
            'user_email'    => $this->faker->unique()->safeEmail(),
        ];
    }


}
