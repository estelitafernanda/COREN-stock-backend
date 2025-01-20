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
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('telephone')->after('name');  
            $table->string('email')->after('telephone'); 
            $table->string('responsible')->after('email');  
            $table->dropColumn('contact');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('telephone');
            $table->dropColumn('email');
            $table->dropColumn('responsible');
            $table->string('contact')->nullable()->after('name');
        });
    }
};
