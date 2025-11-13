<?php

namespace App\Service\UserDashboard;

use App\Base\Response\DataStatus;
use App\Base\Response\DataSuccess;
use App\Http\Enum\User\UserStatusEnum;
use App\Http\Enum\User\UserTypeEnum;
use App\Http\Resources\User\UserResource;
use App\Models\Blog\Blog;
use App\Models\BlogCategory\BlogCategory;
use App\Models\BlogHashtag\BlogHashtag;
use App\Models\CategorySection\CategorySection;
use App\Models\HeroSection\HeroSection;
use App\Models\Location\Location;
use App\Models\PropertyType\PropertyType;
use App\Models\User\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Hash;

class UserDashboardService
{
    public function __construct() {

    }

    public function fetchDashboard(): DataStatus

    {
        // $total_users = User::get();

        $hero_sections = HeroSection::get();
        $category_sections = CategorySection::get();
        $property_types = PropertyType::get();
        $locations = Location::get();
        $blogs = Blog::get();
        $blog_categories = BlogCategory::get();
        $blog_hashtags = BlogHashtag::get();
        $dashboard_data = [
            'hero_sections' => $hero_sections,
            'category_sections' => $category_sections,
            'property_types' => $property_types,
            'locations' => $locations,
            'blogs' => $blogs,
            'blog_categories' => $blog_categories,
            'blog_hashtags' => $blog_hashtags,
        ];
        return DataSuccess::make(resourceData: $dashboard_data, message: 'Dashboard data fetched successfully');
    }


}
