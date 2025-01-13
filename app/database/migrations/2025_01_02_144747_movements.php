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
        Schema::create('movements', function (Blueprint $table) {
            $table->id('idMovement');
<<<<<<< HEAD
            $table->foreignId('idProduct')->constrained('products', 'code'); 
=======
            $table->foreignId('idProduct')->constrained('products', 'idProduct'); 
>>>>>>> 7203ce1aa315dcb84ce7fe741d69c3138bd2e9ec
            $table->integer('quantity');
            $table->date('movementDate');
            $table->foreignId('idResponsible')->constrained('users', 'idUser');
            $table->foreignId('idOriginSector')->constrained('sectors');
            $table->foreignId('idDestinationSector')->constrained('sectors');
            $table->string('movementStatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
