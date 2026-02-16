<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartitRequest;
use App\Http\Resources\PartitResource;
use App\Models\Partit;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    public function index()
    {
        return PartitResource::collection(
            Partit::with(['equipLocal', 'equipVisitant', 'estadi'])
                ->paginate(10)
        );
    }

    public function show(Partit $partit)
    {
        $partit->load(['equipLocal', 'equipVisitant', 'estadi']);
        return new PartitResource($partit);
    }

    public function store(PartitRequest $request)
    {
        $partit = Partit::create($request->validated());
        $partit->load(['equipLocal', 'equipVisitant', 'estadi']);
        
        return response()->json(new PartitResource($partit), 201);
    }

    public function update(PartitRequest $request, Partit $partit)
    {
        $partit->update($request->validated());
        $partit->load(['equipLocal', 'equipVisitant', 'estadi']);
        
        return new PartitResource($partit);
    }

    public function destroy(Partit $partit)
    {
        $partit->delete();
        return response()->noContent(); // 204
    }
}