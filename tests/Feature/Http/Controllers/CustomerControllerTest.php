<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Ccustomer;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CustomerController
 */
final class CustomerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $customers = Customer::factory()->count(3)->create();

        $response = $this->get(route('customers.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $customer = Customer::factory()->create();
        $customers = Customer::factory()->count(3)->create();

        $response = $this->get(route('customers.show', $customer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CustomerController::class,
            'store',
            \App\Http\Requests\CustomerStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $recnum = $this->faker->numberBetween(-100000, 100000);
        $empresa = $this->faker->randomFloat(/** decimal_attributes **/);
        $codigo = $this->faker->randomFloat(/** decimal_attributes **/);
        $raza_social = $this->faker->word();
        $tipo = $this->faker->randomElement(/** enum_attributes **/);
        $cpf_cnpj = $this->faker->word();

        $response = $this->post(route('customers.store'), [
            'recnum' => $recnum,
            'empresa' => $empresa,
            'codigo' => $codigo,
            'raza_social' => $raza_social,
            'tipo' => $tipo,
            'cpf_cnpj' => $cpf_cnpj,
        ]);

        $customers = Customer::query()
            ->where('recnum', $recnum)
            ->where('empresa', $empresa)
            ->where('codigo', $codigo)
            ->where('raza_social', $raza_social)
            ->where('tipo', $tipo)
            ->where('cpf_cnpj', $cpf_cnpj)
            ->get();
        $this->assertCount(1, $customers);
        $customer = $customers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CustomerController::class,
            'update',
            \App\Http\Requests\CustomerUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $customer = Customer::factory()->create();
        $recnum = $this->faker->numberBetween(-100000, 100000);
        $empresa = $this->faker->randomFloat(/** decimal_attributes **/);
        $codigo = $this->faker->randomFloat(/** decimal_attributes **/);
        $raza_social = $this->faker->word();
        $tipo = $this->faker->randomElement(/** enum_attributes **/);
        $cpf_cnpj = $this->faker->word();

        $response = $this->put(route('customers.update', $customer), [
            'recnum' => $recnum,
            'empresa' => $empresa,
            'codigo' => $codigo,
            'raza_social' => $raza_social,
            'tipo' => $tipo,
            'cpf_cnpj' => $cpf_cnpj,
        ]);

        $customer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($recnum, $customer->recnum);
        $this->assertEquals($empresa, $customer->empresa);
        $this->assertEquals($codigo, $customer->codigo);
        $this->assertEquals($raza_social, $customer->raza_social);
        $this->assertEquals($tipo, $customer->tipo);
        $this->assertEquals($cpf_cnpj, $customer->cpf_cnpj);
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $customer = Customer::factory()->create();
        $customers = Customer::factory()->count(3)->create();

        $response = $this->delete(route('customers.destroy', $customer));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertModelMissing($customer);
    }
}
