<?php

namespace App\Repositories;

use App\Models\Fund;
use DB;
use Illuminate\Database\Eloquent\Builder;

class FundRepository
{
    public function getFilteredFunds(?string $name, ?int $manager_id, ?int $year)
    {
        $query = Fund::query()
            ->with(['aliases', 'companies'])
            ->when($name)
            ->where(function (Builder $query) use ($name) {
                $input = '%'.$name.'%';
                $query->where('name', 'like', $input)
                    ->orWhereHas('aliases', function ($query) use ($input) {
                        $query->where('name', 'like', $input);
                    });
            })
            ->when($manager_id)
            ->where('manager_id', $manager_id)
            ->when($year)
            ->where('start_year', $year);

        return $query->paginate();
    }

    public function findFundDuplicateByNameAndManager(Fund $fund): ?Fund
    {
        return Fund::where(function ($query) use ($fund) {
            $query->where('slug', $fund->slug)
                ->orWhereHas('aliases', function ($query) use ($fund) {
                    $slugs = $fund->aliases()->pluck('slug')->toArray();
                    $query->whereIn('slug', $slugs);
                });
        })
            ->where('manager_id', $fund->manager_id)
            ->where('id', '!=', $fund->id)
            ->first();
    }

    public function getDuplicatedFunds()
    {
        return Fund::whereExists(function ($query) {
            $query->selectRaw(1)
                ->from('funds as f2')
                ->whereRaw('f2.id != funds.id')
                ->where(function ($subQuery) {
                    $subQuery->where('f2.name', '=', DB::raw('funds.name'))
                        ->orWhereExists(function ($nestedSubQuery) {
                            $nestedSubQuery->selectRaw(1)
                                ->from('aliases')
                                ->whereRaw('aliases.fund_id = f2.id')
                                ->where('aliases.name', '=', DB::raw('funds.name'));
                        });
                })
                ->whereRaw('f2.manager_id = funds.manager_id');
        })
            ->paginate();
    }

    public function createFund(array $data): Fund
    {
        $fund = Fund::create($data);

        if (isset($data['aliases'])) {
            $fund->aliases = $data['aliases'];
            $fund->save();
        }

        return $fund;
    }

    public function updateFund(Fund $fund, array $data): Fund
    {
        $fund->update($data);
        $fund->aliases = $data['aliases'] ?? [];
        $fund->save();

        return $fund;
    }
}
