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
        Schema::create('delete_token', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->longText('token');
            $table->integer('otp');
            $table->dateTime('expiry_time');
            $table->foreign('email')->references('email')
                ->on('registration')
                ->onUpdate('cascade')
                ->onDelete('cascade');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delete_token');
    }
};
