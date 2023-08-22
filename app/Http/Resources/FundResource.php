<?php

namespace App\Http\Resources;

use App\Models\Fund;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Fund */
class FundResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'aliases' => $this->aliases,
            'companies' => $this->companies->pluck('name')->toArray(),
            'manager_id' => $this->manager_id,
            'manager' => $this->manager->name,
            'start_year' => $this->start_year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
