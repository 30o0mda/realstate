<?php

use App\Http\Controllers\Api\HeroSection\HeroSectionController;
use App\Http\Controllers\Api\CategorySection\CategorySectionController;
use App\Http\Controllers\Api\Location\LocationController;
use App\Http\Controllers\Api\PropertyType\PropertyTypeController;
use App\Http\Controllers\Api\SectionPropertyType\SectionPropertyTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Hero Section
Route::post('/create_hero_section',[HeroSectionController::class,'createHeroSection']);
Route::post('/updata_hero_section',[HeroSectionController::class,'updataHeroSection']);
Route::get('/fetch_hero_section',[HeroSectionController::class,'fetchHeroSection']);
Route::post('/delete_hero_section',[HeroSectionController::class,'deleteHeroSection']);



// Property Type
Route::post('/create_property_type',[PropertyTypeController::class,'createPropertyType']);
Route::post('/updata_property_type',[PropertyTypeController::class,'updataPropertyType']);
Route::get('/fetch_property_type',[PropertyTypeController::class,'fetchPropertyType']);
Route::post('/delete_property_type',[PropertyTypeController::class,'deletePropertyType']);

// Location
Route::post('/create_location',[LocationController::class,'createLocation']);
Route::post('/updata_location',[LocationController::class,'updataLocation']);
Route::get('/fetch_location',[LocationController::class,'fetchLocation']);
Route::post('/fetch_all_locations',[LocationController::class,'fetchAllLocations']);
Route::post('/delete_location',[LocationController::class,'deleteLocation']);

// Category Section
Route::post('/create_or_update_category_section',[CategorySectionController::class,'createOrUpdateCategorySection']);
Route::get('/fetch_category_section',[CategorySectionController::class,'fetchCategorySection']);

// Section Property Type
Route::post('/attach_category_section_property_type',[SectionPropertyTypeController::class,'attachCategorySectionPropertyType']);
