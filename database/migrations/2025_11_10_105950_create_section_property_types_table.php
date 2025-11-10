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
        Schema::create('category_section_property_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'property_type_id')->constrained('property_types')->onDelete('cascade');
            $table->foreignId(column: 'category_section_id')->constrained('category_sections')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_section_property_types');
    }
};
