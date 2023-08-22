<?php

namespace App\Http\Controllers;

use App\Http\Requests\FundManagerRequest;
use App\Http\Resources\FundManagerResource;
use App\Models\FundManager;
use Illuminate\Http\Response;

class FundManagerController extends Controller
{
    public function index()
    {
        return FundManagerResource::collection(FundManager::all());
    }

    public function store(FundManagerRequest $request)
    {
        return new FundManagerResource(FundManager::create($request->validated()));
    }

    public function show(FundManager $manager)
    {
        return new FundManagerResource($manager);
    }

    public function update(FundManagerRequest $request, FundManager $manager)
    {
        $manager->update($request->validated());

        return new FundManagerResource($manager);
    }

    public function destroy(FundManager $manager)
    {
        $manager->delete();

        return response()->json('Deleted', Response::HTTP_NO_CONTENT);
    }
}
