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
        Schema::create('project_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_id');
            $table->foreign('visit_id')->references('id')->on('visits');
            $table->unsignedBigInteger('beneficiary_id');
            $table->foreign('beneficiary_id')->references('id')->on('beneficiaries');
            $table->unsignedBigInteger('distribution_id');
            $table->foreign('distribution_id')->references('id')->on('distributions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_beneficiaries');
    }
};
