<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('request', function (Blueprint $table) {
            $table->enum('type', ['Entrada', 'Saida'])->default('Entrada');
            $table->index('type');
        });
    }

    public function down()
    {
        Schema::table('request', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropColumn('type');
        });
    }
};
