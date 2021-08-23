<?php

namespace App\Http\Requests;

use \Symfony\Component\HttpFoundation\Response as Status;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class VoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Make it false when authentication is set
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'answer' => 'required|integer|min:1'
        ];
    }

    /**
     * Failure message(s)
     */
    protected function failedValidation(Validator $validator) 
    {
        $res = response()->error($validator->errors(), Status::HTTP_BAD_REQUEST);
        throw new HttpResponseException($res);
    }
}
