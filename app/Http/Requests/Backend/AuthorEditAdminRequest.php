<?php

namespace App\Http\Requests\Backend;

use App\Enums\OcupationEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AuthorEditAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $author = $this->route('author');
        
        return [
            'avatar'=> 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fullname' => 'required|string|min:3|max:250',
            'email' => 'required|email|min:3|max:250|unique:authors,email,'.$author->id,
            'ocupation' => ['required', new Enum(OcupationEnum::class)],
            'details'=> 'required|string|min:3|max:6000',
            'active' => 'boolean'
        ];
    }
}
