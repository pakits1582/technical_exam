<?php

namespace Database\Factories;

use App\Models\Factory;
use Illuminate\Database\Eloquent\Factories\Factory as EloquentFactory;

class FactoryFactory extends EloquentFactory
{
    protected $model = Factory::class;

    public function definition()
    {
        return [
            'factory_name' => $this->faker->company,
            'location' => $this->faker->address,
            'email' => $this->faker->unique()->companyEmail,
            'website' => $this->faker->url,
        ];
    }
}

