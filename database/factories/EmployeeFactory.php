<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Factory as FactoryModel; 
use Illuminate\Database\Eloquent\Factories\Factory as EloquentFactory;

class EmployeeFactory extends EloquentFactory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'factory_id' => FactoryModel::factory(),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
