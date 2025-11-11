<?php

namespace App\Http\Requests\BlogCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CreateBlogCategoryRequest extends FormRequest
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
                Rule::unique('blog_category_translations', 'title')->where('locale', $locale),
            ];
        }
        $rules['image'] = 'nullable';
        $rules['slug'] = 'required|unique:blog_categories,slug';
        $rules['alt'] = 'nullable|string';

        return $rules;
    }
}
