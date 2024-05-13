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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->require();
            $table->unsignedBigInteger('county_id');
            $table->foreign('county_id')->references('id')->on('county_types');
            $table->unsignedBigInteger('sponsor_id')->nullable();
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
            $table->integer('total_girls')->nullable();
            $table->string('created_by');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
