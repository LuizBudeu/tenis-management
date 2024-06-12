<?php

namespace App\Http\Resources;

use App\Enums\TennisCourtStatus;
use App\Enums\TennisCourtType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TennisCourtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'court_number' => $this->court_number,
            'court_type' => $this->court_type ?? TennisCourtType::getDefaultValue(),
            'status' => $this->status ?? TennisCourtStatus::getDefaultValue()
        ];
    }
}
