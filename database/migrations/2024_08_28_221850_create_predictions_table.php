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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('game_id');
            $table->tinyInteger('result_0')->nullable();
            $table->tinyInteger('result_1')->nullable();
            $table->tinyInteger('result_2')->nullable();
            $table->softDeletes(); 
            $table->timestamps();
            $table->index('schedule_id');
            $table->index('game_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
