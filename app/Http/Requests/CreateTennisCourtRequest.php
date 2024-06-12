<?php

namespace App\Http\Requests;

use App\Enums\TennisCourtStatus;
use App\Enums\TennisCourtType;
use Illuminate\Foundation\Http\FormRequest;

class CreateTennisCourtRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'court_number' => 'required|integer|unique:tennis_courts,court_number',
            'court_type' => 'nullable|string|in:'. join(',', TennisCourtType::toArray()),
            'status' => 'nullable|string|in:'. join(',', TennisCourtStatus::toArray()),
        ];
    }
}

