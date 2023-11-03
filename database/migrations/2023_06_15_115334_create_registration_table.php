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
        Schema::create('registration', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 50);
            $table->string('email', 50)->unique()->nullable(false);
            $table->string('password', 20)->nullable(false);
            $table->bigInteger('mobile')->nullable(false);
            $table->string('pic', 256)->default('default.png');
            $table->string('role', 20)->default('normal');
            $table->string('status', 10)->default('Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration');
    }
};
