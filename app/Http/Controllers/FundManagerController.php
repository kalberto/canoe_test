<?php

namespace App\Http\Controllers;

use App\Http\Requests\FundManagerRequest;
use App\Http\Resources\FundManagerResource;
use App\Models\FundManager;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class FundManagerController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return FundManagerResource::collection(FundManager::paginate());
    }

    public function store(FundManagerRequest $request): FundManagerResource
    {
        return new FundManagerResource(FundManager::create($request->validated()));
    }

    public function show(FundManager $manager): FundManagerResource
    {
        return new FundManagerResource($manager);
    }

    public function update(FundManagerRequest $request, FundManager $manager): FundManagerResource
    {
        $manager->update($request->validated());

        return new FundManagerResource($manager);
    }

    public function destroy(FundManager $manager): JsonResponse
    {
        $manager->delete();

        return response()->json('Deleted', Response::HTTP_NO_CONTENT);
    }
}
