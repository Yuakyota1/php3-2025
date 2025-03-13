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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name'); 
            $table->text('description')->nullable();
            $table->json('images')->nullable(); // Lưu danh sách ảnh dưới dạng JSON
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade'); // Liên kết với bảng sub_categories
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
