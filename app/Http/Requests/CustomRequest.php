<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CustomRequest extends FormRequest
{
    public function attributes() {
        return [
            'first_name'        =>      'First name',
            'last_name'         =>      'Last name',
            'email'             =>      'Email',
            'phone'             =>      'Phone',
            'card'              =>      'Credit Card',
        ];
    }
 
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }
    
    public function messages() {
        
        $alpha      = 'The field :attribute is alphabetic characters.';
        $required   = 'The field :attribute is mandatory';
        $min        = 'The minimum length of the field :attribute is :min';
        $max        = 'The maximum length of the field :attribute is :max';
        $numeric    = 'The field :attribute value must be numeric.';
        $gte        = 'The field :attribute value must be greater than or equal to zero.';
        $lte        = 'The field :attribute value must be greater than one.';
        $mimes      = 'The file type :attribute must be an image.';
        $email      = 'The field :attribute is an email.';
        $phone      = 'The field :attribute is a phone number.';
        $card       = 'The field :attribute is a credit card.';
        
        return [
            'first_name.required'       => $required,
            'first_name.alpha'          => $alpha,
            'first_name.max'            => $max,
            'last_name.required'        => $required,
            'last_name.alpha'           => $alpha,
            'last_name.max'             => $max,
            'email.required'            => $required,
            'email.email'               => $email,
            'phone.required'            => $phone,
            'phone.min'                 => $phone,
            'card.required'             => $card,
            'card.max'                  => $card,
        ];
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
            'first_name'    =>      'required|alpha|max:40', 
            'last_name'     =>      'required|alpha|max:40',
            'email'         =>      'required|email', // regex:/^.+@.+$/i
            'phone'         =>      'required|min:9',
            'card'          =>      'required|max:19',
            // 'file'      =>      'nullable|mimes:jpeg,gif,png,jpg',
        ];
    }
}
