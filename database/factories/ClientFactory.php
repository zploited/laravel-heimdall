<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Zploited\Heimdall\Models\Client;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'redirect_uri' => [$this->faker->url()],
            'secret' => Str::random(64)
        ];
    }
}