<?php

namespace App\Modules\Course\Services;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Modules\Course\Http\Resources\CourseResource;
use App\Modules\Course\Models\Course;
use App\Modules\Course\Repositories\CourseRepository;
class CourseService
{
    public function __construct(protected CourseRepository $courseRepository) {}

    public function createCourse($dto): DataStatus
    {
        $course = $this->courseRepository->create($dto);
        return DataSuccess::make(resourceData: new CourseResource($course), message: 'Course created successfully');
    }

    public function updataCourse($dto): DataStatus
    {
        $course = $this->courseRepository->updata($dto);
        return DataSuccess::make(resourceData: new CourseResource($course), message: 'Course updated successfully');
    }

    public function fetchCourses($dto): DataStatus
    {
        $courses = $this->courseRepository->fetchCourses($dto);
        if(isset($dto->with_pagination) && $dto->with_pagination == 1) {
            $per_page = $dto->per_page ?? 10;
            $courses = $courses->paginate($per_page);
            $response = CourseResource::collection($courses)->response()->getData(true);
        }else{
            $response = CourseResource::collection($courses->get());
        }
        return DataSuccess::make($response, message: 'Courses fetched successfully');
    }
    public function fetchCoursesDetails($dto): DataStatus
    {
        $course = $this->courseRepository->fetchCoursesDetails($dto);
        return DataSuccess::make(resourceData: new CourseResource($course), message: 'Course details fetched successfully');
    }

    public function deleteCourse($dto): DataStatus
    {
        $course = $this->courseRepository->delete($dto);
        return DataSuccess::make(message: 'Course deleted successfully');
    }
}
