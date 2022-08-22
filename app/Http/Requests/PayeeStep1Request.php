<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayeeStep1Request extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'contact_name' => 'required|max:30',
            'phone' => 'required|max:30',
            'email' => 'required'
        ];
    }
}
