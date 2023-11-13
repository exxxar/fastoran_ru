<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $type = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $discount_price = $this->faker->randomFloat(/** double_attributes **/);
        $in_stop_list = $this->faker->boolean;
        $company = Company::factory()->create();

        $response = $this->post(route('product.store'), [
            'type' => $type,
            'status' => $status,
            'price' => $price,
            'discount_price' => $discount_price,
            'in_stop_list' => $in_stop_list,
            'company_id' => $company->id,
        ]);

        $products = Product::query()
            ->where('type', $type)
            ->where('status', $status)
            ->where('price', $price)
            ->where('discount_price', $discount_price)
            ->where('in_stop_list', $in_stop_list)
            ->where('company_id', $company->id)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.show', $product));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $product = Product::factory()->create();
        $type = $this->faker->numberBetween(-10000, 10000);
        $status = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->randomFloat(/** double_attributes **/);
        $discount_price = $this->faker->randomFloat(/** double_attributes **/);
        $in_stop_list = $this->faker->boolean;
        $company = Company::factory()->create();

        $response = $this->put(route('product.update', $product), [
            'type' => $type,
            'status' => $status,
            'price' => $price,
            'discount_price' => $discount_price,
            'in_stop_list' => $in_stop_list,
            'company_id' => $company->id,
        ]);

        $product->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($type, $product->type);
        $this->assertEquals($status, $product->status);
        $this->assertEquals($price, $product->price);
        $this->assertEquals($discount_price, $product->discount_price);
        $this->assertEquals($in_stop_list, $product->in_stop_list);
        $this->assertEquals($company->id, $product->company_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('product.destroy', $product));

        $response->assertNoContent();

        $this->assertModelMissing($product);
    }
}
