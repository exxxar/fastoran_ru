<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Company;
use App\Models\Order;
use App\Models\ReceiverLocation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderController
 */
class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('order.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'store',
            \App\Http\Requests\OrderStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $company = Company::factory()->create();
        $user = User::factory()->create();
        $product_count = $this->faker->numberBetween(-10000, 10000);
        $summary_price = $this->faker->randomFloat(/** double_attributes **/);
        $delivery_price = $this->faker->randomFloat(/** double_attributes **/);
        $delivery_range = $this->faker->randomFloat(/** double_attributes **/);
        $deliveryman_latitude = $this->faker->randomFloat(/** double_attributes **/);
        $deliveryman_longitude = $this->faker->randomFloat(/** double_attributes **/);
        $receiver_location = ReceiverLocation::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $order_type = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('order.store'), [
            'company_id' => $company->id,
            'user_id' => $user->id,
            'product_count' => $product_count,
            'summary_price' => $summary_price,
            'delivery_price' => $delivery_price,
            'delivery_range' => $delivery_range,
            'deliveryman_latitude' => $deliveryman_latitude,
            'deliveryman_longitude' => $deliveryman_longitude,
            'receiver_location_id' => $receiver_location->id,
            'status' => $status,
            'order_type' => $order_type,
        ]);

        $orders = Order::query()
            ->where('company_id', $company->id)
            ->where('user_id', $user->id)
            ->where('product_count', $product_count)
            ->where('summary_price', $summary_price)
            ->where('delivery_price', $delivery_price)
            ->where('delivery_range', $delivery_range)
            ->where('deliveryman_latitude', $deliveryman_latitude)
            ->where('deliveryman_longitude', $deliveryman_longitude)
            ->where('receiver_location_id', $receiver_location->id)
            ->where('status', $status)
            ->where('order_type', $order_type)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('order.show', $order));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'update',
            \App\Http\Requests\OrderUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $order = Order::factory()->create();
        $company = Company::factory()->create();
        $user = User::factory()->create();
        $product_count = $this->faker->numberBetween(-10000, 10000);
        $summary_price = $this->faker->randomFloat(/** double_attributes **/);
        $delivery_price = $this->faker->randomFloat(/** double_attributes **/);
        $delivery_range = $this->faker->randomFloat(/** double_attributes **/);
        $deliveryman_latitude = $this->faker->randomFloat(/** double_attributes **/);
        $deliveryman_longitude = $this->faker->randomFloat(/** double_attributes **/);
        $receiver_location = ReceiverLocation::factory()->create();
        $status = $this->faker->numberBetween(-10000, 10000);
        $order_type = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('order.update', $order), [
            'company_id' => $company->id,
            'user_id' => $user->id,
            'product_count' => $product_count,
            'summary_price' => $summary_price,
            'delivery_price' => $delivery_price,
            'delivery_range' => $delivery_range,
            'deliveryman_latitude' => $deliveryman_latitude,
            'deliveryman_longitude' => $deliveryman_longitude,
            'receiver_location_id' => $receiver_location->id,
            'status' => $status,
            'order_type' => $order_type,
        ]);

        $order->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($company->id, $order->company_id);
        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($product_count, $order->product_count);
        $this->assertEquals($summary_price, $order->summary_price);
        $this->assertEquals($delivery_price, $order->delivery_price);
        $this->assertEquals($delivery_range, $order->delivery_range);
        $this->assertEquals($deliveryman_latitude, $order->deliveryman_latitude);
        $this->assertEquals($deliveryman_longitude, $order->deliveryman_longitude);
        $this->assertEquals($receiver_location->id, $order->receiver_location_id);
        $this->assertEquals($status, $order->status);
        $this->assertEquals($order_type, $order->order_type);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('order.destroy', $order));

        $response->assertNoContent();

        $this->assertModelMissing($order);
    }
}
