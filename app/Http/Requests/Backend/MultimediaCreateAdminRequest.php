<?php

namespace App\Http\Requests\Backend;

use App\Enums\MultimediaTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class MultimediaCreateAdminRequest extends FormRequest
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
        $url_rule = '';
        if($this->type == MultimediaTypeEnum::PICTURE->value){
            $url_rule = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }else{
            $url_rule = 'required|string|min:3|max:250';
        }
        return [
            'title'=> 'required|string|min:3|max:250|unique:multimedias,title',
            'foot' => 'nullable|string|min:3|max:250',
            'url'=> $url_rule,
            'type' => ['required', new Enum(MultimediaTypeEnum::class)],
            'author' => 'required|numeric|exists:authors,id'
        ];
    }
}
