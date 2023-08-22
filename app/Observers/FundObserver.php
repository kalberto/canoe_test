<?php

namespace App\Observers;

use App\Events\DuplicateFundWarning;
use App\Models\Fund;
use App\Repositories\FundRepository;

class FundObserver
{
    protected FundRepository $fundRepository;

    public function __construct(FundRepository $fundRepository)
    {
        $this->fundRepository = $fundRepository;
    }

    public function saved(Fund $fund): void
    {
        $existingFund = $this->fundRepository->findFundDuplicateByNameAndManager($fund);

        if ($existingFund) {
            event(new DuplicateFundWarning($fund));
        }
    }
}
