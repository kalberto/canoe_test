<?php

namespace Database\Factories;

use App\Models\Alias;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AliasFactory extends Factory
{
    protected $model = Alias::class;

    public function definition(): array
    {
        return [
            'name' => $name = $this->faker->name(),
            'slug' => Str::slug($name),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
