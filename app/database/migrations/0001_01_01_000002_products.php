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
        Schema::create('products', function (Blueprint $table) {
            $table->id('code')->primary();
            $table->foreignId('idDepartment')->constrained('sectors'); 
            $table->string('nameProduct');
            $table->text('describe');
            $table->integer('minQuantity');
            $table->integer('currentQuantity');
            $table->string('location');
            $table->date('validity');
            $table->float('unitPrice');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
