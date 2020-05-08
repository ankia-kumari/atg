<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class AddAtgRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|unique:users,email',
            'pincode' => 'required|digits:6'
        ];
    }

    // override function

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();

        $validation = [];

        foreach ($errors as $field => $messages) {
            $validation[$field] = $messages[0];
        }

        if ($this->is('api/*') && !$this->ajax()) {
            throw new HttpResponseException(response()->json($validation, 422));
        }

        else{
            throw (new ValidationException($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
}
