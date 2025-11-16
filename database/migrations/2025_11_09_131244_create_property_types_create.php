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
        Schema::create('property_types', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->boolean('is_active')->default(true)->nullable();
            $table->timestamps();
        });

        Schema::create('property_type_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->unique(['property_type_id', 'locale']);
            $table->foreignId('property_type_id')->constrained('property_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_types_create');
        Schema::dropIfExists('property_type_translations');
    }
};
