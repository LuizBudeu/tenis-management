<?php

namespace App\Http\Requests\TennisCourt;

use App\Enums\TennisCourtStatus;
use App\Enums\TennisCourtType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateTennisCourtRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'court_type' => 'nullable|string|in:'. join(',', TennisCourtType::toArray()),
            'status' => 'nullable|string|in:'. join(',', TennisCourtStatus::toArray()),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(array_filter($this->all(), function ($value) {
            return $value !== null;
        }));
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->hasAny(['court_type', 'status'])) {
                $validator->errors()->add('fields', 'At least one field (court_type or status) must be provided for update.');
            }
        });
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new ValidationException($validator, response()->json($validator->errors(), 400));
    }
}

