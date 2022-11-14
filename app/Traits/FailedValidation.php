<?php

namespace App\Traits;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidation
{
    /**
     * Throw an exception if validation fails.
     *
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException($this->failure('Validation errors.', 422, $validator->errors()));
    }
}
