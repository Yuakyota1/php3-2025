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
        Schema::table('product_size_colors', function (Blueprint $table) {
            $table->decimal('import_price', 10, 2)->after('price');
            $table->decimal('regular_price', 10, 2)->after('import_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_size_colors', function (Blueprint $table) {
            $table->dropColumn(['import_price', 'regular_price']);
        });
    }
};
