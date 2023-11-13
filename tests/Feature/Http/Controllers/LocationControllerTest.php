<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Location;
use App\Models\Object;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LocationController
 */
class LocationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $locations = Location::factory()->count(3)->create();

        $response = $this->get(route('location.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LocationController::class,
            'store',
            \App\Http\Requests\LocationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $region = $this->faker->word;
        $city = $this->faker->city;
        $address = $this->faker->word;
        $object_type = $this->faker->numberBetween(-10000, 10000);
        $object = Object::factory()->create();

        $response = $this->post(route('location.store'), [
            'region' => $region,
            'city' => $city,
            'address' => $address,
            'object_type' => $object_type,
            'object_id' => $object->id,
        ]);

        $locations = Location::query()
            ->where('region', $region)
            ->where('city', $city)
            ->where('address', $address)
            ->where('object_type', $object_type)
            ->where('object_id', $object->id)
            ->get();
        $this->assertCount(1, $locations);
        $location = $locations->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $location = Location::factory()->create();

        $response = $this->get(route('location.show', $location));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LocationController::class,
            'update',
            \App\Http\Requests\LocationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $location = Location::factory()->create();
        $region = $this->faker->word;
        $city = $this->faker->city;
        $address = $this->faker->word;
        $object_type = $this->faker->numberBetween(-10000, 10000);
        $object = Object::factory()->create();

        $response = $this->put(route('location.update', $location), [
            'region' => $region,
            'city' => $city,
            'address' => $address,
            'object_type' => $object_type,
            'object_id' => $object->id,
        ]);

        $location->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($region, $location->region);
        $this->assertEquals($city, $location->city);
        $this->assertEquals($address, $location->address);
        $this->assertEquals($object_type, $location->object_type);
        $this->assertEquals($object->id, $location->object_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $location = Location::factory()->create();

        $response = $this->delete(route('location.destroy', $location));

        $response->assertNoContent();

        $this->assertModelMissing($location);
    }
}
