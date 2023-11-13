<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientCategory;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\IngredientController
 */
class IngredientControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $ingredients = Ingredient::factory()->count(3)->create();

        $response = $this->get(route('ingredient.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\IngredientController::class,
            'store',
            \App\Http\Requests\IngredientStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $ingredient_category = IngredientCategory::factory()->create();
        $product = Product::factory()->create();
        $is_checked = $this->faker->boolean;
        $is_disabled = $this->faker->boolean;

        $response = $this->post(route('ingredient.store'), [
            'ingredient_category_id' => $ingredient_category->id,
            'product_id' => $product->id,
            'is_checked' => $is_checked,
            'is_disabled' => $is_disabled,
        ]);

        $ingredients = Ingredient::query()
            ->where('ingredient_category_id', $ingredient_category->id)
            ->where('product_id', $product->id)
            ->where('is_checked', $is_checked)
            ->where('is_disabled', $is_disabled)
            ->get();
        $this->assertCount(1, $ingredients);
        $ingredient = $ingredients->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->get(route('ingredient.show', $ingredient));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\IngredientController::class,
            'update',
            \App\Http\Requests\IngredientUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $ingredient = Ingredient::factory()->create();
        $ingredient_category = IngredientCategory::factory()->create();
        $product = Product::factory()->create();
        $is_checked = $this->faker->boolean;
        $is_disabled = $this->faker->boolean;

        $response = $this->put(route('ingredient.update', $ingredient), [
            'ingredient_category_id' => $ingredient_category->id,
            'product_id' => $product->id,
            'is_checked' => $is_checked,
            'is_disabled' => $is_disabled,
        ]);

        $ingredient->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($ingredient_category->id, $ingredient->ingredient_category_id);
        $this->assertEquals($product->id, $ingredient->product_id);
        $this->assertEquals($is_checked, $ingredient->is_checked);
        $this->assertEquals($is_disabled, $ingredient->is_disabled);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->delete(route('ingredient.destroy', $ingredient));

        $response->assertNoContent();

        $this->assertModelMissing($ingredient);
    }
}
