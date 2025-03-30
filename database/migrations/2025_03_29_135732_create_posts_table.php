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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('title');
            $table->text('description');
            $table->string('user_id');
            $table->foreign('user_id')
            ->nullable()
            ->references('id')
            ->on('users')->onDelete('cascade');
            $table->foreignId('category_id')
            ->nullable()
            ->references('id')
            ->on('categories')->onDelete('cascade');
            $table->foreignId('city_id')
            ->nullable()
            ->references('id')
            ->on('cities')->onDelete('cascade');
            $table->integer('avg_persons')->default(1);
            $table->enum('status', ['active', 'done', 'closed'])->default('active');
            $table->integer('help_count')->default(0);
            $table->string('level')->default('none');
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
