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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('password')->nullable()->change();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->unsignedTinyInteger(column: 'status')->nullable()->default(0)->comment('0 = pending, 1 = accepted, 2 = rejected');
            $table->unsignedTinyInteger(column: 'type')->nullable()->default(1)->comment('1 = Client, 2 = broker, 3 = agent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->string('password')->change();
            $table->dropColumn('address');
            $table->dropColumn('image');
            $table->dropColumn('status');
            $table->dropColumn('type');
        });
    }
};
