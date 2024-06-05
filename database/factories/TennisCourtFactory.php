<?php

namespace Database\Factories;

use App\Enums\TennisCourtStatus;
use App\Enums\TennisCourtType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TennisCourt>
 */
class TennisCourtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $courtNumber = 1;

        return [
            'court_number' => $courtNumber++,
        ];
    }
}
