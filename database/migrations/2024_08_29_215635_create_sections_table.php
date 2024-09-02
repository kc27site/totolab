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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->unsignedBigInteger('game_id')->nullable();
            $table->smallInteger('type');
            $table->integer('position');
            $table->text('content')->nullable();
            $table->string('image_url', 255)->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index('blog_id');
            $table->index('schedule_id');
            $table->index('game_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
