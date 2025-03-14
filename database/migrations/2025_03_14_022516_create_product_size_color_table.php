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
        Schema::create('product_size_colors', function (Blueprint $table) {
            $table->id(); // Tự động là bigIncrements
            $table->unsignedBigInteger('idProduct');
            $table->string('color', 50);
            $table->unsignedBigInteger('idSize');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();

            // Định nghĩa khóa ngoại với kiểu dữ liệu đúng
            $table->foreign('idProduct')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('idSize')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_size_colors');
    }
};
