<?php

namespace Wotz\FilamentRedirects\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Wotz\FilamentRedirects\Models\Redirect;

class RedirectFactory extends Factory
{
    protected $model = Redirect::class;

    public function definition()
    {
        return [
            'sort_order' => fake()->randomNumber(),
            'from' => '/' . fake()->slug(),
            'to' => '/' . fake()->slug(),
            'status' => fake()->randomElement([301, 302]),
            'pass_query_string' => fake()->boolean(),
            'online' => fake()->boolean(),
        ];
    }
}
