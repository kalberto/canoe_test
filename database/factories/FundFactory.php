<?php

namespace Database\Factories;

use App\Models\Alias;
use App\Models\Company;
use App\Models\Fund;
use App\Models\FundManager;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FundFactory extends Factory
{
    protected $model = Fund::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'manager_id' => $this->getFundManagerId(),
            'start_year' => random_int(1990, 2023),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Fund $fund) {
            $this->attachCompanies($fund);
            $this->createAliases($fund);
        });
    }

    private function getFundManagerId(): int
    {
        if (FundManager::exists()) {
            // Get a random FundManager
            $fundManagerId = FundManager::inRandomOrder()->first()->id;
        } else {
            // Create a new FundManager
            $fundManagerId = FundManager::factory()->create()->id;
        }

        return $fundManagerId;
    }

    private function attachCompanies(Fund $fund): void
    {
        // Check if there are any companies in the database
        if (Company::exists()) {
            // Define how many companies to attach
            $numCompanies = $this->faker->numberBetween(1, 3);

            // Attach companies to the fund
            $companyIds = Company::inRandomOrder()->limit($numCompanies)->pluck('id');
            $fund->companies()->attach($companyIds);
        } else {
            // Create a new company and attach it to the fund
            $company = Company::factory()->create();
            $fund->companies()->attach($company->id);
        }
    }

    private function createAliases(Fund $fund): void
    {
        // Define how many aliases to create
        $numAliases = $this->faker->numberBetween(1, 5);

        // Create aliases for the fund
        for ($i = 0; $i < $numAliases; $i++) {
            Alias::factory()->create([
                'fund_id' => $fund->id,
                'name' => $name = $this->faker->name(),
                'slug' => Str::slug($name),
            ]);
        }
    }
}
