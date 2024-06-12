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
            'court_type' => empty($this->court_type) ? TennisCourtType::getDefaultValue() : $this->court_type,
            'status' => empty($this->status) ? TennisCourtStatus::getDefaultValue() : $this->status,
        ];
    }
}
