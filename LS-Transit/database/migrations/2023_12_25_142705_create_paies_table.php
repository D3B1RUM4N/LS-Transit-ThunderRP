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
        Schema::create('paies', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('login');
            $table->decimal('montant', 15, 2);
            $table->date('datePaie');

            $table->foreign('login')->references('login')->on('myusers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paies');
    }
};
