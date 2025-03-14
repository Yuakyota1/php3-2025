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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã giảm giá
            $table->enum('type', ['percentage', 'fixed'])->default('fixed'); // Kiểu giảm giá: phần trăm hoặc cố định
            $table->decimal('discount', 10, 2); // Giá trị giảm giá
            $table->integer('usage_limit')->nullable(); // Giới hạn số lần sử dụng
            $table->integer('used_count')->default(0); // Số lần đã sử dụng
            $table->date('expiry_date')->nullable(); // Ngày hết hạn
            $table->boolean('status')->default(1); // Trạng thái (1: kích hoạt, 0: vô hiệu)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
