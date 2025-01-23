<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->unsignedBigInteger('idRequest')->nullable();
            $table->foreign('idRequest')->references('idRequest')->on('request')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('movements', function (Blueprint $table) {
            $table->dropForeign(['idRequest']);
            $table->dropColumn('idRequest');
        });
    }
    
};
