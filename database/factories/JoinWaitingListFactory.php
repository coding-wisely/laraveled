<?php

namespace Database\Factories;

use App\Models\JoinWaitingList;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JoinWaitingListFactory extends Factory
{
    protected $model = JoinWaitingList::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
