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
        $rules ['blog_id'] = 'required|exists:blogs,id';
        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules["title_$locale"] = [
                'nullable',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'title')->where('locale', $locale)->ignore($this->blog_id, 'blog_id'),
            ];
            $rules["description_$locale"] = [
                'nullable',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'description')->where('locale', $locale)->ignore($this->blog_id, 'blog_id'),
            ];
            $rules["meta_title_$locale"] = [
                'nullable',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'meta_title')->where('locale', $locale)->ignore($this->blog_id, 'blog_id'),
            ];
            $rules["meta_description_$locale"] = [
                'nullable',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'meta_description')->where('locale', $locale)->ignore($this->blog_id, 'blog_id'),
            ];
        }
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
