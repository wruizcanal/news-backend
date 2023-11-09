<?php

namespace App\Http\Requests\Backend;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class NewsEditAdminRequest extends FormRequest
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
        $news = $this->route('news');

        return [
            'title'=> 'required|string|min:3|max:250|unique:news,title,'.$news->id,
            'summary' => 'required|string|min:3|max:6000',
            'content'=> 'required|string',
            'status' => ['required', new Enum(StatusEnum::class)],
            'open_close' => 'boolean',
            'category' => 'required|numeric|exists:categories,id',
            'cover_picture' => 'required|array|exists:multimedias,id'
        ];
    }
}
