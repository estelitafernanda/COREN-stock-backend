<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->enum('type', ['Entrada', 'Saida'])->default('Saida');
            $table->foreign('type')
                ->references('type') 
                ->on('request')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->dropForeign(['type']);
            $table->dropColumn('type');
        });
    }
};
