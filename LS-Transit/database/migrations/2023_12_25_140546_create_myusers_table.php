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
        Schema::create('myusers', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('login')->unique();
			$table->text('password');
            $table->decimal('km', 15 ,2)->default(0);
            $table->decimal('montant', 15 ,2)->default(0);
            $table->integer('grade')->default(0);
            $table->boolean('admin')->default(false);
            
            $table->foreign('grade')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('myusers');
    }
};
