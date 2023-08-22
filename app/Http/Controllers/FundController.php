<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterFundsRequest;
use App\Http\Requests\FundRequest;
use App\Http\Resources\FundResource;
use App\Models\Fund;
use App\Services\FundService;
use Illuminate\Http\Response;

class FundController extends Controller
{
    protected $fundService;

    public function __construct(FundService $fundService)
    {
        $this->fundService = $fundService;
    }

    public function index(FilterFundsRequest $request)
    {
        $funds = $this->fundService->getFunds($request);

        return FundResource::collection($funds);
    }

    public function getDuplicatedFunds()
    {
        $duplicatedFunds = $this->fundService->getDuplicatedFunds();

        return FundResource::collection($duplicatedFunds);
    }

    public function store(FundRequest $request)
    {
        $data = $request->validated();
        $fund = Fund::create($data);

        if (isset($data['aliases'])) {
            $fund->aliases = $data['aliases'];
            $fund->save();
        }

        return new FundResource($fund);
    }

    public function show(Fund $fund)
    {
        return new FundResource($fund);
    }

    public function update(FundRequest $request, Fund $fund)
    {
        $fund->update($data = $request->validated());
        $fund->aliases = $data['aliases'] ?? [];
        $fund->save();

        return new FundResource($fund);
    }

    public function destroy(Fund $fund)
    {
        $fund->delete();

        return response()->json('Deleted', Response::HTTP_NO_CONTENT);
    }
}
