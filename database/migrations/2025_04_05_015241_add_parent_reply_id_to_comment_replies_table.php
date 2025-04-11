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
        Schema::table('comment_replies', function (Blueprint $table) {
            $table->bigInteger('comment_id')->unsigned()->nullable()->change();
        });
        
    }
    
    public function down()
    {
        Schema::table('comment_replies', function (Blueprint $table) {
            $table->integer('comment_id')->nullable(false)->change();
        });
    }
    
};
