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
        Schema::create('choose_us_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained('organizations')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('organization_employees')->onDelete('cascade');
            $table->foreignId('choose_us_home_id')->nullable()->constrained('choose_us_homes')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('choose_us_feature_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unique(['choose_us_feature_id', 'locale'], 'choose_us_feature_locale_unique');
            $table->foreignId('choose_us_feature_id')->constrained('choose_us_features')->onDelete('cascade')->name('choose_feature_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choose_us_features');
        Schema::dropIfExists('choose_us_feature_translations');
    }
};
