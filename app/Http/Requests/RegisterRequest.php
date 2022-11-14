<?php

namespace App\Http\Requests;

use App\Traits\AuthorizedValidation;
use App\Traits\FailedValidation;
use App\Traits\RespondWithHttpStatus;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users,email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'type' => 'nullable|in:APPROVER',
            'password' => 'required|string|min:6',
        ];
    }
}
