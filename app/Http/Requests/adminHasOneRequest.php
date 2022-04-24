<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class adminHasOneRequest extends FormRequest
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
            'name' => ['required', Rule::unique('member')->ignore($this->id)],
            'address' => 'required',
            'email' => ['required', Rule::unique('member')->ignore($this->id)],
            'phone_number' => ['required', Rule::unique('phone')->ignore($this->id)],
        ];
    }
}
