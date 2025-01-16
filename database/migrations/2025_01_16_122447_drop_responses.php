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
        Schema::dropIfExists('responses'); // Remove a tabela, se ela existir
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('', function (Blueprint $table) {
            $table->id('idResponse');
            $table->boolean('isValid');
            $table->text('response');
            $table->timestamps();
        });
    }
};
