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
        Schema::create('factures', function (Blueprint $table) {
            //counter
            $table->id()->autoIncrement();
            $table->text('login');
            $table->text('client');
            $table->decimal('kilometrique', 15, 2);
            $table->decimal('montant', 15, 2);
            $table->text('vehicule');
            $table->date('dateFacture');
            $table->timestamps();

            $table->foreign('login')->references('login')->on('myusers');
            $table->foreign('vehicule')->references('vehicule')->on('tarifs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
