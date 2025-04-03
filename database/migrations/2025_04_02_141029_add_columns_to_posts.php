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
        Schema::table('posts', function (Blueprint $table) {
            $table->tinyInteger('phone_one_has_viber')->default(0);
            $table->tinyInteger('phone_two_has_viber')->default(0);
            $table->text('location_link')->nullable();
            $table->text('additional_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('phone_one_has_viber');
            $table->dropColumn('phone_two_has_viber');
            $table->dropColumn('location_link');
            $table->dropColumn('additional_link');
        });
    }
};
