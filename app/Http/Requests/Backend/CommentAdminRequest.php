<?php

namespace App\Http\Requests\Backend;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CommentAdminRequest extends FormRequest
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
        return [
            'author' => 'required|string|min:3|max:250',
            'content'=> 'required|string|min:3|max:6000',
            'status' => ['required', new Enum(StatusEnum::class)],
            'news' => 'required|numeric|exists:news,id'
        ];
    }
}
