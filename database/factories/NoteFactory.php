<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            //
            'title' => $this->faker->words(5, true),
            'content' => $this->faker->words(5, true),
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,

        ];
    }
}