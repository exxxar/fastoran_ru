<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoneyTransferStoreRequest;
use App\Http\Requests\MoneyTransferUpdateRequest;
use App\Http\Resources\MoneyTransferCollection;
use App\Http\Resources\MoneyTransferResource;
use App\Models\MoneyTransfer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MoneyTransferController extends Controller
{
    public function index(Request $request): Response
    {
        $moneyTransfers = MoneyTransfer::all();

        return new MoneyTransferCollection($moneyTransfers);
    }

    public function store(MoneyTransferStoreRequest $request): Response
    {
        $moneyTransfer = MoneyTransfer::create($request->validated());

        return new MoneyTransferResource($moneyTransfer);
    }

    public function show(Request $request, MoneyTransfer $moneyTransfer): Response
    {
        return new MoneyTransferResource($moneyTransfer);
    }

    public function update(MoneyTransferUpdateRequest $request, MoneyTransfer $moneyTransfer): Response
    {
        $moneyTransfer->update($request->validated());

        return new MoneyTransferResource($moneyTransfer);
    }

    public function destroy(Request $request, MoneyTransfer $moneyTransfer): Response
    {
        $moneyTransfer->delete();

        return response()->noContent();
    }
}
