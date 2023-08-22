<?php

namespace App\Services;

use App\Http\Requests\FilterFundsRequest;
use App\Models\Fund;
use App\Repositories\FundRepository;
use Illuminate\Database\Eloquent\Builder;

class FundService
{
    protected $fundRepository;

    public function __construct(FundRepository $fundRepository)
    {
        $this->fundRepository = $fundRepository;
    }

    public function getFunds(FilterFundsRequest $request)
    {
        $name = $request->get('name');
        $manager_id = $request->get('manager_id');
        $year = $request->get('year');

        return $this->fundRepository->getFilteredFunds($name, $manager_id, $year);
    }

    public function getDuplicatedFunds()
    {
        return $this->fundRepository->getDuplicatedFunds();
    }
}
