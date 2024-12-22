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
        Schema::create('dropouts', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->require(true);
            $table->string('class')->require(true);
            $table->string('reason')->require(true);
            $table->date('date_dropout')->nullable(true);
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropouts');
    }
};
