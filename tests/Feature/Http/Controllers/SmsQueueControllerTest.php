<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\SmsQueue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SmsQueueController
 */
class SmsQueueControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $smsQueues = SmsQueue::factory()->count(3)->create();

        $response = $this->get(route('sms-queue.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SmsQueueController::class,
            'store',
            \App\Http\Requests\SmsQueueStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $phone = $this->faker->phoneNumber;
        $message = $this->faker->word;
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('sms-queue.store'), [
            'phone' => $phone,
            'message' => $message,
            'status' => $status,
        ]);

        $smsQueues = SmsQueue::query()
            ->where('phone', $phone)
            ->where('message', $message)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $smsQueues);
        $smsQueue = $smsQueues->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $smsQueue = SmsQueue::factory()->create();

        $response = $this->get(route('sms-queue.show', $smsQueue));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SmsQueueController::class,
            'update',
            \App\Http\Requests\SmsQueueUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $smsQueue = SmsQueue::factory()->create();
        $phone = $this->faker->phoneNumber;
        $message = $this->faker->word;
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('sms-queue.update', $smsQueue), [
            'phone' => $phone,
            'message' => $message,
            'status' => $status,
        ]);

        $smsQueue->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($phone, $smsQueue->phone);
        $this->assertEquals($message, $smsQueue->message);
        $this->assertEquals($status, $smsQueue->status);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $smsQueue = SmsQueue::factory()->create();

        $response = $this->delete(route('sms-queue.destroy', $smsQueue));

        $response->assertNoContent();

        $this->assertModelMissing($smsQueue);
    }
}
