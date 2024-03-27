<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Customer;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            //'recnum' => $this->faker->numberBetween(-100000, 100000),
            'empresa' => Company::factory()->create()->codigo,
            'codigo' => $this->faker->randomFloat(0, 0, 9999.),
            'razao_social' => $this->faker->regexify('[A-Za-z]{10}'),
            'tipo' => $this->faker->randomElement(["PJ","PF"]),
            'cpf_cnpj' => $this->faker->regexify('[0-9]{14}'),
        ];
    }
}
