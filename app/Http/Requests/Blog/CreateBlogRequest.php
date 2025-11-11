<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateBlogRequest extends FormRequest
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

        foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
            $rules["title_$locale"] = [
                'required',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'title')->where('locale', $locale),
            ];
            $rules["description_$locale"] = [
                'required',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'description')->where('locale', $locale),
            ];
            $rules["subtitle_$locale"] = [
                'required',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'subtitle')->where('locale', $locale),
            ];
            $rules["meta_title_$locale"] = [
                'required',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'meta_title')->where('locale', $locale),
            ];
            $rules["meta_description_$locale"] = [
                'required',
                'string',
                'min:2',
                Rule::unique('blog_translations', 'meta_description')->where('locale', $locale),
            ];
        }
        $rules['image'] = 'nullable';
        $rules['slug'] = 'required|unique:blogs,slug';
        $rules['alt'] = 'nullable|string';
        $rules['is_active'] = 'nullable|boolean';
        $rules['blog_category_ids'] = 'required|array';
        $rules['blog_category_ids.*'] = 'required|exists:blog_categories,id';
        
        $rules['blog_hashtag_ids'] = 'required|array';
        $rules['blog_hashtag_ids.*'] = 'required|exists:blog_hashtags,id';

        return $rules;
    }
}
