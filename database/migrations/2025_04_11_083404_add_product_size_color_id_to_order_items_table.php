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
        Schema::table('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('product_size_color_id')->nullable()->after('product_id');
    
            // Nếu bạn muốn ràng buộc khóa ngoại:
            $table->foreign('product_size_color_id')
                  ->references('id')
                  ->on('product_size_colors')
                  ->onDelete('set null');
        });
    }
    
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['product_size_color_id']);
            $table->dropColumn('product_size_color_id');
        });
    }
    
};
