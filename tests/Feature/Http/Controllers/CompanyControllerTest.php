<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CompanyController
 */
final class CompanyControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $companies = Company::factory()->count(3)->create();

        $response = $this->get(route('companies.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $company = Company::factory()->create();
        $companies = Company::factory()->count(3)->create();

        $response = $this->get(route('companies.show', $company));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CompanyController::class,
            'store',
            \App\Http\Requests\CompanyStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $recnum = $this->faker->numberBetween(-100000, 100000);
        $empresa = $this->faker->randomFloat(/** decimal_attributes **/);
        $sigla = $this->faker->word();
        $raza_social = $this->faker->word();

        $response = $this->post(route('companies.store'), [
            'recnum' => $recnum,
            'empresa' => $empresa,
            'sigla' => $sigla,
            'raza_social' => $raza_social,
        ]);

        $companies = Company::query()
            ->where('recnum', $recnum)
            ->where('empresa', $empresa)
            ->where('sigla', $sigla)
            ->where('raza_social', $raza_social)
            ->get();
        $this->assertCount(1, $companies);
        $company = $companies->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CompanyController::class,
            'update',
            \App\Http\Requests\CompanyUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $company = Company::factory()->create();
        $recnum = $this->faker->numberBetween(-100000, 100000);
        $empresa = $this->faker->randomFloat(/** decimal_attributes **/);
        $sigla = $this->faker->word();
        $raza_social = $this->faker->word();

        $response = $this->put(route('companies.update', $company), [
            'recnum' => $recnum,
            'empresa' => $empresa,
            'sigla' => $sigla,
            'raza_social' => $raza_social,
        ]);

        $company->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($recnum, $company->recnum);
        $this->assertEquals($empresa, $company->empresa);
        $this->assertEquals($sigla, $company->sigla);
        $this->assertEquals($raza_social, $company->raza_social);
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $company = Company::factory()->create();
        $companies = Company::factory()->count(3)->create();

        $response = $this->delete(route('companies.destroy', $company));

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertModelMissing($company);
    }
}
