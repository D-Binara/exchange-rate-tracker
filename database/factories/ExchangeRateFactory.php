<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ExchangeRate;

class ExchangeRateFactory extends Factory
{
    protected $model = ExchangeRate::class;

    public function definition()
    {
        return [
            'buying_price' => $this->faker->randomFloat(4, 300, 400),
            'selling_price' => $this->faker->randomFloat(4, 400, 500),
            'fetched_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
