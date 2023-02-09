<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|string|email',
            'phone' => 'required|max:15|string',
            'subject' => 'required|max:255|string',
            'message' => 'required|max:1000|string',
        ];
    }

    public function messages()
    {
        return [
             'email.required'=>'You cant leave Email field empty',
		     'name.required'=>'You cant leave name field empty',
             'phone.required'=>'You cant leave phone field empty',
             'subject.required'=>'You cant leave subject field empty',
             'message.required'=>'You cant leave message field empty',
        ];
    }
}
