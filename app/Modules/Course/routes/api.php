<?php

use App\Modules\Course\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::post('/create_courses', [CourseController::class, 'createCourse']);
Route::post('/updata_courses', [CourseController::class, 'updataCourse']);
Route::post('/fetch_courses', [CourseController::class, 'fetchCourses']);
Route::get('/fetch_courses_details', [CourseController::class, 'fetchCoursesDetails']);
Route::post('/delete_courses', [CourseController::class, 'deleteCourse']);
