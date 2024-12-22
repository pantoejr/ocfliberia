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
        Schema::create('graduates', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->require();
            $table->unsignedBigInteger('school_type_id');
            $table->foreign('school_type_id')->references('id')->on('school_types');
            $table->string('school_graduated')->require(true);
            $table->string('class_graduated')->nullable(true);
            $table->date('date_graduated');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('graduates');
    }
};
