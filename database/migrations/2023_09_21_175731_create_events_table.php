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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->string('subtitle',100);
            $table->string('description', 500);
            $table->date('event_date');
            $table->string('city',100);
            $table->string('main_image', 500);
            $table->string('event_image1', 500);
            $table->string('event_image2', 500);
            $table->string('event_image3', 500);
            $table->string('event_image4', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
