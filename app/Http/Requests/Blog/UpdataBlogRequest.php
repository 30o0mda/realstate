<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Validation\Rule;


class UpdataBlogRequest extends FormRequest
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
        $rules['blog_id'] = 'required|exists:blogs,id';

        $rules["title_en"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules['title_ar'] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules["description_en"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules['description_ar'] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules["subtitle_en"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules["subtitle_ar"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules["meta_title_en"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules["meta_title_ar"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules["meta_description_en"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules["meta_description_ar"] = [
            'nullable',
            'string',
            'min:2',
        ];
        $rules['image'] = 'nullable';
        $rules['slug'] = [
            'nullable',
            Rule::unique('blogs', 'slug')->ignore($this->blog_id, 'id'),
        ];
        $rules['alt'] = 'nullable|string';
        $rules['is_active'] = 'nullable|boolean';
        $rules['blog_category_ids'] = 'required|array';
        $rules['blog_category_ids.*'] = 'required|exists:blog_categories,id';
        $rules['blog_hashtag_ids'] = 'required|array';
        $rules['blog_hashtag_ids.*'] = 'required|exists:blog_hashtags,id';
        return $rules;
    }
}
