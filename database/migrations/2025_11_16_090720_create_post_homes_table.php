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
        Schema::create('post_homes', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->foreignId('organization_id')->constrained('organizations')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('organization_employees')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('post_home_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unique(['post_home_id', 'locale']);
            $table->foreignId('post_home_id')->constrained('post_homes')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_homes');
        Schema::dropIfExists('post_home_translations');
    }
};
