<?php

namespace App\Http\Requests;

use App\Traits\AuthorizedValidation;
use App\Traits\FailedValidation;
use App\Traits\RespondWithHttpStatus;
use Illuminate\Foundation\Http\FormRequest;

class TravelPaymentRequest extends FormRequest
{
    use RespondWithHttpStatus;
    use AuthorizedValidation;
    use FailedValidation;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|between:0,999999.99'
        ];
    }
}
