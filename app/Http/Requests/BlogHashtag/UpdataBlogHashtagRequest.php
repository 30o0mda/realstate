<?php

namespace App\Http\Requests\BlogHashtag;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Validation\Rule;


class UpdataBlogHashtagRequest extends FormRequest
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
        $rules = [];
            $rules["title_en"] = [
                'nullable',
                'string',
                'min:2',
            ];
            $rules["title_ar"] = [
                'nullable',
                'string',
                'min:2',
            ];
        $rules['image'] = 'nullable';
        $rules['blog_hashtag_id'] = 'required|exists:blog_hashtags,id';
        $rules['slug'] = [
            'nullable',
            Rule::unique('blog_hashtags', 'slug')->ignore($this->blog_hashtag_id, 'id'),
        ];
        $rules['alt'] = 'nullable|string';
        $rules['is_active'] = 'nullable|boolean';
        return $rules;
    }
}
