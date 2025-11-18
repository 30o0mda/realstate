<?php

use App\Modules\GeneralData\Http\Controllers\HeroSection\HeroSectionController;
use Illuminate\Support\Facades\Route;


Route::prefix("organization")->group(function () {
    Route::middleware("auth:employee")->group(function () {
        Route::post('/create_hero_section', [HeroSectionController::class, 'createHeroSection']);
        Route::post('/updata_hero_section', [HeroSectionController::class, 'updataHeroSection']);
        Route::post('/fetch_hero_section', [HeroSectionController::class, 'fetchHeroSections']);
        Route::get('/fetch_hero_section_details', [HeroSectionController::class, 'fetchHeroSectionDetails']);
        Route::post('/delete_hero_section', [HeroSectionController::class, 'deleteHeroSection']);
    });
});
