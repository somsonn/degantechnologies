<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->text('description')->change(); // Change column type to TEXT
        });
    }
    
    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('description', 255)->change(); // Revert to original length
        });
    }
    
};
