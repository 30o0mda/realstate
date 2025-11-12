<?php

use App\Http\Controllers\Api\Blog\BlogController;
use App\Http\Controllers\Api\BlogCategory\BlogCategoryController;
use App\Http\Controllers\Api\BlogHashtag\BlogHashtagController;
use App\Http\Controllers\Api\HeroSection\HeroSectionController;
use App\Http\Controllers\Api\CategorySection\CategorySectionController;
use App\Http\Controllers\Api\Location\LocationController;
use App\Http\Controllers\Api\Organization\OrganizationController;
use App\Http\Controllers\Api\OrganizationEmployee\OrganizationEmployeeController;
use App\Http\Controllers\Api\PropertyType\PropertyTypeController;
use App\Http\Controllers\Api\SectionPropertyType\SectionPropertyTypeController;
use App\Http\Controllers\Api\UserController;
use App\Models\BlogCategory\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->group(function () {
    Route::post('/register', [UserController::class, 'registerUser']);
    Route::post('/login', [UserController::class, 'loginUser']);
    Route::middleware('auth:user')->group(function () {
        
    });
});


Route::prefix('organization')->group(function () {
    Route::post('/organization_login', [OrganizationEmployeeController::class, 'loginOrganization']);
    Route::middleware('auth:employee')->group(function () {
        // Hero Section
        Route::post('/create_hero_section', [HeroSectionController::class, 'createHeroSection']);
        Route::post('/updata_hero_section', [HeroSectionController::class, 'updataHeroSection']);
        Route::post('/fetch_hero_section', [HeroSectionController::class, 'fetchHeroSections']);
        Route::get('/fetch_hero_section_details', [HeroSectionController::class, 'fetchHeroSectionDetails']);
        Route::post('/delete_hero_section', [HeroSectionController::class, 'deleteHeroSection']);

        // Property Type
        Route::post('/create_property_type', [PropertyTypeController::class, 'createPropertyType']);
        Route::post('/updata_property_type', [PropertyTypeController::class, 'updataPropertyType']);
        Route::post('/fetch_property_type', [PropertyTypeController::class, 'fetchPropertyType']);
        Route::get('/fetch_property_type_details', [PropertyTypeController::class, 'fetchPropertyTypeDetails']);
        Route::post('/delete_property_type', [PropertyTypeController::class, 'deletePropertyType']);

        // Location
        Route::post('/create_location', [LocationController::class, 'createLocation']);
        Route::post('/updata_location', [LocationController::class, 'updataLocation']);
        Route::post('/fetch_location', [LocationController::class, 'fetchLocation']);
        Route::get('/fetch_location_details', [LocationController::class, 'fetchLocationDetails']);
        Route::post('/fetch_all_locations', [LocationController::class, 'fetchAllLocations']);
        Route::post('/delete_location', [LocationController::class, 'deleteLocation']);

        // Category Section
        Route::post('/create_or_update_category_section', [CategorySectionController::class, 'createOrUpdateCategorySection']);
        Route::get('/fetch_category_section', [CategorySectionController::class, 'fetchCategorySection']);

        // Section Property Type
        Route::post('/attach_category_section_property_type', [SectionPropertyTypeController::class, 'attachCategorySectionPropertyType']);

        // Blog
        Route::post('/create_blog', [BlogController::class, 'createBlog']);
        Route::post('/updata_blog', [BlogController::class, 'updataBlog']);
        Route::post('/fetch_blog', [BlogController::class, 'fetchBlog']);
        Route::get('/fetch_blog_details', [BlogController::class, 'fetchBlogDetails']);
        Route::post('/delete_blog', [BlogController::class, 'deleteBlog']);

        // Blog Category
        Route::post('/create_blog_category', [BlogCategoryController::class, 'createBlogCategory']);
        Route::post('/updata_blog_category', [BlogCategoryController::class, 'updataBlogCategory']);
        Route::post('/fetch_blog_category', [BlogCategoryController::class, 'fetchBlogCategory']);
        Route::get('/fetch_blog_category_details', [BlogCategoryController::class, 'fetchBlogCategoryDetails']);
        Route::post('/delete_blog_category', [BlogCategoryController::class, 'deleteBlogCategory']);

        //Blog Hashtag
        Route::post('/create_blog_hashtag', [BlogHashtagController::class, 'createBlogHashtag']);
        Route::post('/updata_blog_hashtag', [BlogHashtagController::class, 'updataBlogHashtag']);
        Route::post('/fetch_blog_hashtag', [BlogHashtagController::class, 'fetchBlogHashtag']);
        Route::get('/fetch_blog_hashtag_details', [BlogHashtagController::class, 'fetchBlogHashtagDetails']);
        Route::post('/delete_blog_hashtag', [BlogHashtagController::class, 'deleteBlogHashtag']);
    });
});


// // Hero Section
// Route::post('/create_hero_section', [HeroSectionController::class, 'createHeroSection']);
// Route::post('/updata_hero_section', [HeroSectionController::class, 'updataHeroSection']);
// Route::post('/fetch_hero_section', [HeroSectionController::class, 'fetchHeroSections']);
// Route::get('/fetch_hero_section_details', [HeroSectionController::class, 'fetchHeroSectionDetails']);
// Route::post('/delete_hero_section', [HeroSectionController::class, 'deleteHeroSection']);
