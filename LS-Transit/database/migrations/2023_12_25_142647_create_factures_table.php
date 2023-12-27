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
            $table->integer('emp');
            $table->text('client');
            $table->decimal('kilometrique', 15, 2);
            $table->decimal('montant', 15, 2);
            $table->decimal('tarif', 15, 2);
            $table->date('dateFacture');
            $table->timestamps();

            $table->foreign('emp')->references('id')->on('myusers');
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
