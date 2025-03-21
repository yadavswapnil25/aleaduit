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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_society');
            $table->string('chairman')->nullable();
            $table->string('vice_chairman')->nullable();
            $table->string('manager')->nullable();
            $table->string('registration_no')->unique();
            $table->string('lekha_parikshan_vargwari')->nullable();
            $table->integer('total_shakha')->nullable();
            $table->string('district')->nullable();
            $table->string('taluka')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('karyashetra')->nullable();
            $table->string('society_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
