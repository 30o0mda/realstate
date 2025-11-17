<?php

namespace App\Modules\Course\Repositories;

use App\Modules\Course\Http\Resources\CourseResource;
use App\Modules\Course\Models\Course;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CourseRepository
{

    public function create($dto)
    {
        try {
            $data = $dto->toArray();
            $data['image'] = uploadImage($data['image'], 'course', 'public');
            foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
                $data[$locale] = [
                    'title' => $data['title_' . $locale] ?? null,
                    'description' => $data['description_' . $locale] ?? null,
                ];
            }
            $course = Course::create($data);
            return $course;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function updata($dto)
    {
        try {
            $course = Course::find($dto->course_id);
            $data = $dto->toArray();
            $data['image'] = uploadImage($data['image'], 'course', 'public');
            foreach (LaravelLocalization::getSupportedLanguagesKeys() as $locale) {
                $data[$locale] = [
                    'title' => $data['title_' . $locale] ?? null,
                    'description' => $data['description_' . $locale] ?? null,
                ];
            }
            $course->update($data);
            return $course;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

public function fetchCourses( $dto)
{
    try {
        $query = Course::query();
        if (!empty($dto->word)) {
            $query->whereTranslationLike('title', '%' . $dto->word . '%');
        }
        return $query->latest();
    } catch (\Throwable $th) {
        throw $th;
    }
}


    public function fetchCoursesDetails($dto)
    {
        try {
            $course = Course::find($dto->course_id);
            return $course;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($dto)
    {
        try {
            $course = Course::find($dto->course_id);
            $course->delete();
            return $course;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
