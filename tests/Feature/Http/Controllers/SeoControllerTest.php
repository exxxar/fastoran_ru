<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Seo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SeoController
 */
class SeoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $seos = Seo::factory()->count(3)->create();

        $response = $this->get(route('seo.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SeoController::class,
            'store',
            \App\Http\Requests\SeoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $company = Company::factory()->create();

        $response = $this->post(route('seo.store'), [
            'company_id' => $company->id,
        ]);

        $seos = Seo::query()
            ->where('company_id', $company->id)
            ->get();
        $this->assertCount(1, $seos);
        $seo = $seos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $seo = Seo::factory()->create();

        $response = $this->get(route('seo.show', $seo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SeoController::class,
            'update',
            \App\Http\Requests\SeoUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $seo = Seo::factory()->create();
        $company = Company::factory()->create();

        $response = $this->put(route('seo.update', $seo), [
            'company_id' => $company->id,
        ]);

        $seo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($company->id, $seo->company_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $seo = Seo::factory()->create();

        $response = $this->delete(route('seo.destroy', $seo));

        $response->assertNoContent();

        $this->assertModelMissing($seo);
    }
}
