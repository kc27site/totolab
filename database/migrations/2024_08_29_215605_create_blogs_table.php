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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->nullable();
            $table->integer('schedule_no')->nullable();
            $table->smallInteger('type');
            $table->integer('status')->default(0);
            $table->string('title', 255)->nullable();
            $table->timestamp('released_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index('no');
            $table->index('schedule_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
