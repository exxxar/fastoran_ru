<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeoStoreRequest;
use App\Http\Requests\SeoUpdateRequest;
use App\Http\Resources\SeoCollection;
use App\Http\Resources\SeoResource;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function index(Request $request): Response
    {
        $seos = Seo::all();

        return new SeoCollection($seos);
    }

    public function store(SeoStoreRequest $request): Response
    {
        $seo = Seo::create($request->validated());

        return new SeoResource($seo);
    }

    public function show(Request $request, Seo $seo): Response
    {
        return new SeoResource($seo);
    }

    public function update(SeoUpdateRequest $request, Seo $seo): Response
    {
        $seo->update($request->validated());

        return new SeoResource($seo);
    }

    public function destroy(Request $request, Seo $seo): Response
    {
        $seo->delete();

        return response()->noContent();
    }
}
