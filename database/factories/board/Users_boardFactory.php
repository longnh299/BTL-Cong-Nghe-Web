<?php

namespace Database\Factories\Board;

use App\Models\Board\Users_board;
use Illuminate\Database\Eloquent\Factories\Factory;

class Users_boardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Users_board::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_user' => $this->faker->numberBetween(1, 20),
            'id_board' => $this->faker->numberBetween(1, 20),
        ];
    }
}
