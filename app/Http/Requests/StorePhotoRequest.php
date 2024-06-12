<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePhotoRequest extends FormRequest
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
        if (Str::startsWith($this->thumb, 'https://')) {
            $validation = 'url';
        } else {
            $validation = 'image|max:1024';
        }

        return [
            'title' => 'required|min:10|max:100',
            'description' => 'nullable|min:40|max:2000',
            'cover_image' => 'required|'.$validation,
            'category_id' => 'nullable|exists:categories,id',
            'slug' => 'nullable',
            'file_size' => 'nullable|max:1024',
            'format' => 'nullable',
        ];
    }
}
