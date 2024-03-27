<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Company;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            //'recnum' => $this->faker->numberBetween(-100000, 100000),
            'codigo' => $this->faker->randomFloat(0, 0, 9999.),
            'empresa' => $this->faker->randomFloat(0, 0, 9999.),
            'sigla' => $this->faker->regexify('[A-Za-z]{10}'),
            'razao_social' => $this->faker->regexify('[A-Za-z]{10}'),
        ];
    }
}
