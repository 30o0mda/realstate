<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('hero_sections')) {
            Schema::table('hero_sections', function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('organization_employees')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('category_sections')) {
            Schema::table('category_sections', function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('organization_employees')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('property_types')) {
            Schema::table('property_types', function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('organization_employees')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('locations')) {
            Schema::table('locations', function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('organization_employees')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('organization_employees')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('blog_hashtags')) {
            Schema::table('blog_hashtags', function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('organization_employees')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('blog_categories')) {
            Schema::table('blog_categories', function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
                $table->foreign('created_by')->references('id')->on('organization_employees')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['organization_id', 'created_by']);
        });
        Schema::table('category_sections', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['organization_id', 'created_by']);
        });
        Schema::table('property_types', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['organization_id', 'created_by']);
        });
        Schema::table('locations', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['organization_id', 'created_by']);
        });
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['organization_id', 'created_by']);
        });
        Schema::table('blog_hashtags', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['organization_id', 'created_by']);
        });
        Schema::table('blog_categories', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn(['organization_id', 'created_by']);
        });
    }
};
