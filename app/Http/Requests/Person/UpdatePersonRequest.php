<?php

namespace App\Http\Requests\Person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePersonRequest extends FormRequest
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
            'cpf' => [
                'required',
                'regex:/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/',
                Rule::unique('persons')->where(function ($query) {
                    $query->where('uuid', '<>', $this->uuid);
                }),
            ],
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('persons')->where(function ($query) {
                    $query->where('uuid', '<>', $this->uuid);
                }),
            ],
            'phone' => [
                'required',
                Rule::unique('persons')->where(function ($query) {
                    $query->where('uuid', '<>', $this->uuid);
                }),
            ],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'cpf.required'   => __('The document is required.'),
            'cpf.unique'     => __('There is already a user with this document.'),
            'name.required'       => __('The name is required.'),
            'email.required'      => __('The email is required.'),
            'email.unique'        => __('There is already a user with this e-mail.'),
            'phone.required'  => __('The cellphone is required.'),
            'phone.unique'  => __('The cellphone has already been taken.'),
        ];
    }
}
