<?php

use App\Http\Controllers\Api\Blog\BlogController;
use App\Http\Controllers\Api\BlogCategory\BlogCategoryController;
use App\Http\Controllers\Api\BlogHashtag\BlogHashtagController;
use App\Http\Controllers\Api\HeroSection\HeroSectionController;
use App\Http\Controllers\Api\CategorySection\CategorySectionController;
use App\Http\Controllers\Api\ChooseUsFeature\ChooseUsFeatureController;
use App\Http\Controllers\Api\ChooseUsHome\ChooseUsHomeController;
use App\Http\Controllers\Api\Location\LocationController;
use App\Http\Controllers\Api\OrganizationEmployee\OrganizationEmployeeController;
use App\Http\Controllers\Api\PostHome\PostHomeController;
use App\Http\Controllers\Api\PropertyType\PropertyTypeController;
use App\Http\Controllers\Api\SectionPropertyType\SectionPropertyTypeController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\UserDashboard\UserDashboardController;
use App\Http\Controllers\UserWebSite\Blog\BlogWebsiteController;
use App\Http\Controllers\UserWebSite\BlogCategory\BlogCategoryWebsiteController;
use App\Http\Controllers\UserWebSite\BlogHashtag\BlogHashtagWebsiteController;
use App\Http\Controllers\UserWebSite\CategorySection\CategorySectionWebsiteController;
use App\Http\Controllers\UserWebSite\ChooseUsHome\ChooseUsHomeWebsiteController;
use App\Http\Controllers\UserWebSite\HeroSection\HeroSectionWebsiteController;
use App\Http\Controllers\UserWebSite\PostHome\PostHomeWebsiteController;
use App\Http\Controllers\UserWebSite\PropertyType\PropertyTypeWebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('user')->group(function () {
    Route::post('/register_user', [UserController::class, 'registerUser']);
    Route::post('/login_user', [UserController::class, 'loginUser']);
    Route::middleware('auth:user')->group(function () {
        Route::get('/fetch_data', [UserDashboardController::class, 'fetchDashboard']);
        Route::post('/fetch_blog', [BlogWebsiteController::class, 'fetchBlog']);
        Route::get('/fetch_blog_details', [BlogWebsiteController::class, 'fetchBlogDetails']);
        Route::post('/fetch_blog_category', [BlogCategoryWebsiteController::class, 'fetchBlogCategory']);
        Route::get('/fetch_blog_category_details', [BlogCategoryWebsiteController::class, 'fetchBlogCategoryDetails']);
        Route::post('/fetch_blog_hashtag', [BlogHashtagWebsiteController::class, 'fetchBlogHashtag']);
        Route::get('/fetch_blog_hashtag_details', [BlogHashtagWebsiteController::class, 'fetchBlogHashtagDetails']);
        Route::get('/fetch_category_section', [CategorySectionWebsiteController::class, 'fetchCategorySection']);
        Route::post('/fetch_hero_section', [HeroSectionWebsiteController::class, 'fetchHeroSection']);
        Route::get('/fetch_hero_section_details', [HeroSectionWebsiteController::class, 'fetchHeroSectionDetails']);
        Route::post('/fetch_location', [LocationController::class, 'fetchLocation']);
        Route::get('/fetch_location_details', [LocationController::class, 'fetchLocationDetails']);
        Route::post('/fetch_all_location', [LocationController::class, 'fetchAllLocations']);
        Route::post('/fetch_property_type', [PropertyTypeWebsiteController::class, 'fetchPropertyType']);
        Route::get('/fetch_property_type_details', [PropertyTypeWebsiteController::class, 'fetchPropertyTypeDetails']);
        Route::get('/fetch_post_home', [PostHomeWebsiteController::class, 'fetchPostHome']);
        Route::get('/fetch_choose_us_home', [ChooseUsHomeWebsiteController::class, 'fetchChooseUsHome']);
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

        // Post Home
        Route::post('/create_or_update_post_home', [PostHomeController::class, 'createOrUpdatePostHome']);
        Route::get('/fetch_post_home', [PostHomeController::class, 'fetchPostHome']);

        // Choose Us Home
        Route::post('/create_or_update_choose_us_home', [ChooseUsHomeController::class, 'createOrUpdateChooseUsHome']);
        Route::get('/fetch_choose_us_home', [ChooseUsHomeController::class, 'fetchChooseUsHome']);
    });
});


// // Hero Section
// Route::post('/create_hero_section', [HeroSectionController::class, 'createHeroSection']);
// Route::post('/updata_hero_section', [HeroSectionController::class, 'updataHeroSection']);
// Route::post('/fetch_hero_section', [HeroSectionController::class, 'fetchHeroSections']);
// Route::get('/fetch_hero_section_details', [HeroSectionController::class, 'fetchHeroSectionDetails']);
// Route::post('/delete_hero_section', [HeroSectionController::class, 'deleteHeroSection']);
