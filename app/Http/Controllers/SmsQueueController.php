<?php

namespace App\Http\Controllers;

use App\Http\Requests\SmsQueueStoreRequest;
use App\Http\Requests\SmsQueueUpdateRequest;
use App\Http\Resources\SmsQueueCollection;
use App\Http\Resources\SmsQueueResource;
use App\Models\SmsQueue;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SmsQueueController extends Controller
{
    public function index(Request $request): Response
    {
        $smsQueues = SmsQueue::all();

        return new SmsQueueCollection($smsQueues);
    }

    public function store(SmsQueueStoreRequest $request): Response
    {
        $smsQueue = SmsQueue::create($request->validated());

        return new SmsQueueResource($smsQueue);
    }

    public function show(Request $request, SmsQueue $smsQueue): Response
    {
        return new SmsQueueResource($smsQueue);
    }

    public function update(SmsQueueUpdateRequest $request, SmsQueue $smsQueue): Response
    {
        $smsQueue->update($request->validated());

        return new SmsQueueResource($smsQueue);
    }

    public function destroy(Request $request, SmsQueue $smsQueue): Response
    {
        $smsQueue->delete();

        return response()->noContent();
    }
}
