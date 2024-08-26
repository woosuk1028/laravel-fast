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
        Schema::create('tb_app_info', function (Blueprint $table) {
            $table->string('app_key', 5)->primary()->comment('앱키');
            // tinyInteger integer 
            // default('1')
            // nullable()
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_info');
    }
};
