<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\MoneyTransfer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MoneyTransferController
 */
class MoneyTransferControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $moneyTransfers = MoneyTransfer::factory()->count(3)->create();

        $response = $this->get(route('money-transfer.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MoneyTransferController::class,
            'store',
            \App\Http\Requests\MoneyTransferStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $amount = $this->faker->randomFloat(/** double_attributes **/);
        $card = $this->faker->word;
        $description = $this->faker->text;
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('money-transfer.store'), [
            'amount' => $amount,
            'card' => $card,
            'description' => $description,
            'status' => $status,
        ]);

        $moneyTransfers = MoneyTransfer::query()
            ->where('amount', $amount)
            ->where('card', $card)
            ->where('description', $description)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $moneyTransfers);
        $moneyTransfer = $moneyTransfers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $moneyTransfer = MoneyTransfer::factory()->create();

        $response = $this->get(route('money-transfer.show', $moneyTransfer));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MoneyTransferController::class,
            'update',
            \App\Http\Requests\MoneyTransferUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $moneyTransfer = MoneyTransfer::factory()->create();
        $amount = $this->faker->randomFloat(/** double_attributes **/);
        $card = $this->faker->word;
        $description = $this->faker->text;
        $status = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('money-transfer.update', $moneyTransfer), [
            'amount' => $amount,
            'card' => $card,
            'description' => $description,
            'status' => $status,
        ]);

        $moneyTransfer->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($amount, $moneyTransfer->amount);
        $this->assertEquals($card, $moneyTransfer->card);
        $this->assertEquals($description, $moneyTransfer->description);
        $this->assertEquals($status, $moneyTransfer->status);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $moneyTransfer = MoneyTransfer::factory()->create();

        $response = $this->delete(route('money-transfer.destroy', $moneyTransfer));

        $response->assertNoContent();

        $this->assertModelMissing($moneyTransfer);
    }
}
