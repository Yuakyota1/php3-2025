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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'discount_applied')) {
                $table->decimal('discount_applied', 10, 2)->default(0);
            }
            $table->decimal('discount_applied', 10, 2)->change();
        });
    }
    
    
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('discount_applied');
        });
    }
    
};
