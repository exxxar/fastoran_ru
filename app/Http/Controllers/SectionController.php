<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionStoreRequest;
use App\Http\Requests\SectionUpdateRequest;
use App\Http\Resources\SectionCollection;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SectionController extends Controller
{
    public function index(Request $request): Response
    {
        $sections = Section::all();

        return new SectionCollection($sections);
    }

    public function store(SectionStoreRequest $request): Response
    {
        $section = Section::create($request->validated());

        return new SectionResource($section);
    }

    public function show(Request $request, Section $section): Response
    {
        return new SectionResource($section);
    }

    public function update(SectionUpdateRequest $request, Section $section): Response
    {
        $section->update($request->validated());

        return new SectionResource($section);
    }

    public function destroy(Request $request, Section $section): Response
    {
        $section->delete();

        return response()->noContent();
    }
}
