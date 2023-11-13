<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Story;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StoryController
 */
class StoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $stories = Story::factory()->count(3)->create();

        $response = $this->get(route('story.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StoryController::class,
            'store',
            \App\Http\Requests\StoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $company = Company::factory()->create();
        $lifetime = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('story.store'), [
            'company_id' => $company->id,
            'lifetime' => $lifetime,
        ]);

        $stories = Story::query()
            ->where('company_id', $company->id)
            ->where('lifetime', $lifetime)
            ->get();
        $this->assertCount(1, $stories);
        $story = $stories->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $story = Story::factory()->create();

        $response = $this->get(route('story.show', $story));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StoryController::class,
            'update',
            \App\Http\Requests\StoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $story = Story::factory()->create();
        $company = Company::factory()->create();
        $lifetime = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('story.update', $story), [
            'company_id' => $company->id,
            'lifetime' => $lifetime,
        ]);

        $story->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($company->id, $story->company_id);
        $this->assertEquals($lifetime, $story->lifetime);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $story = Story::factory()->create();

        $response = $this->delete(route('story.destroy', $story));

        $response->assertNoContent();

        $this->assertModelMissing($story);
    }
}
