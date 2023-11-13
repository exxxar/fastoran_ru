<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductCategoryController
 */
class ProductCategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $productCategories = ProductCategory::factory()->count(3)->create();

        $response = $this->get(route('product-category.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductCategoryController::class,
            'store',
            \App\Http\Requests\ProductCategoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $title = $this->faker->sentence(4);
        $company = Company::factory()->create();

        $response = $this->post(route('product-category.store'), [
            'title' => $title,
            'company_id' => $company->id,
        ]);

        $productCategories = ProductCategory::query()
            ->where('title', $title)
            ->where('company_id', $company->id)
            ->get();
        $this->assertCount(1, $productCategories);
        $productCategory = $productCategories->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $productCategory = ProductCategory::factory()->create();

        $response = $this->get(route('product-category.show', $productCategory));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductCategoryController::class,
            'update',
            \App\Http\Requests\ProductCategoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $productCategory = ProductCategory::factory()->create();
        $title = $this->faker->sentence(4);
        $company = Company::factory()->create();

        $response = $this->put(route('product-category.update', $productCategory), [
            'title' => $title,
            'company_id' => $company->id,
        ]);

        $productCategory->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $productCategory->title);
        $this->assertEquals($company->id, $productCategory->company_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $productCategory = ProductCategory::factory()->create();

        $response = $this->delete(route('product-category.destroy', $productCategory));

        $response->assertNoContent();

        $this->assertModelMissing($productCategory);
    }
}
