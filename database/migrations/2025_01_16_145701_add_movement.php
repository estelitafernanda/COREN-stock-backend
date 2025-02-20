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
        Schema::table('movements', function (Blueprint $table) {

            $table->unsignedBigInteger('idUserRequest');
            $table->foreign('idUserRequest')
                  ->references('idUser')
                  ->on('request')
                  ->onDelete('cascade');

            $table->foreignId('idUserResponse')
                  ->nullable()
                  ->constrained('users', 'idUser')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movements', function (Blueprint $table) {

            $table->dropForeign(['idUserRequest']);
            $table->dropColumn('idUserRequest');

            $table->dropForeign(['idUserResponse']);
            $table->dropColumn('idUserResponse');
        });
    }
};
