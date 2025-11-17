<?php

namespace App\Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Course\DTOs\CourseDto;
use App\Modules\Course\DTOs\CourseFilterDto;
use App\Modules\Course\Http\Requests\CreateCourseRequest;
use App\Modules\Course\Http\Requests\DeleteCourseRequest;
use App\Modules\Course\Http\Requests\FetchCourseDetailsRequest;
use App\Modules\Course\Http\Requests\FetchCoursesRequest;
use App\Modules\Course\Http\Requests\UpdateCourseRequest;
use App\Modules\Course\Services\CourseService;

class CourseController extends Controller
{

    protected $CourseService;

    public function __construct(protected CourseService $courseService)
    {
    }

    public function createCourse(CreateCourseRequest $request) {
        $dto = new CourseDto(
            title_en: $request->title_en,
            title_ar: $request->title_ar,
            description_en: $request->description_en,
            description_ar: $request->description_ar,
            image: $request->image
        );
        return $this->courseService->createCourse($dto)->response();
    }

    public function updataCourse(UpdateCourseRequest $request) {
        $dto = new CourseDto(
            title_en: $request->title_en,
            title_ar: $request->title_ar,
            description_en: $request->description_en,
            description_ar: $request->description_ar,
            image: $request->image,
            course_id: $request->course_id
        );
        return $this->courseService->updataCourse($dto)->response()->getData();
    }

    public function fetchCourses(FetchCoursesRequest $request) {
        $dto = new CourseFilterDto(
            word: $request->word,
            with_pagination: $request->with_pagination,
            per_page: $request->per_page
        );
        return $this->courseService->fetchCourses($dto)->response()->getData();
    }

    public function fetchCoursesDetails(FetchCourseDetailsRequest $request) {
        $dto = new CourseDto(
            course_id: $request->course_id
        );
        return $this->courseService->fetchCoursesDetails($dto)->response()->getData();
    }



    public function deleteCourse(DeleteCourseRequest $request) {
        $dto = new CourseDto(
            course_id: $request->course_id
        );
        return $this->courseService->deleteCourse($dto)->response()->getData();
    }

}
