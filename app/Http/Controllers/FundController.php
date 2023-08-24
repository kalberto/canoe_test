<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterFundsRequest;
use App\Http\Requests\FundRequest;
use App\Http\Resources\FundResource;
use App\Models\Fund;
use App\Services\FundService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class FundController extends Controller
{
    protected FundService $fundService;

    public function __construct(FundService $fundService)
    {
        $this->fundService = $fundService;
    }

    public function index(FilterFundsRequest $request): AnonymousResourceCollection
    {
        $funds = $this->fundService->getFunds($request);

        return FundResource::collection($funds);
    }

    public function getDuplicatedFunds(): AnonymousResourceCollection
    {
        $duplicatedFunds = $this->fundService->getDuplicatedFunds();

        return FundResource::collection($duplicatedFunds);
    }

    public function store(FundRequest $request): FundResource
    {
        $fund = $this->fundService->createFund($request->validated());

        return new FundResource($fund);
    }

    public function show(Fund $fund): FundResource
    {
        return new FundResource($fund);
    }

    public function update(FundRequest $request, Fund $fund):FundResource
    {
        $this->fundService->updateFund($fund, $request->validated());

        return new FundResource($fund);
    }

    public function destroy(Fund $fund): JsonResponse
    {
        $fund->delete();

        return response()->json('Deleted', Response::HTTP_NO_CONTENT);
    }
}
