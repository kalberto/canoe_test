<?php

namespace Tests;

use App\Models\Fund;
use App\Models\FundManager;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createFunds(int $amount = 5): void
    {
        Fund::factory($amount)->create();
    }

    public function createManager(): FundManager
    {
        return FundManager::factory(1)->create()->first();
    }
}
