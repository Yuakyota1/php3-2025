<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('orderCode')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('phone');
            $table->text('note')->nullable();
            $table->decimal('total_price', 15, 2);
            $table->string('payment_method');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('orders');
    }
}; 