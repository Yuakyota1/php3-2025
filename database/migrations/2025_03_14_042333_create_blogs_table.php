<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề bài viết
            $table->string('slug')->unique(); // Slug SEO
            $table->text('content'); // Nội dung bài viết
            $table->string('image')->nullable(); // Hình ảnh
            $table->unsignedBigInteger('post_category_id'); // ID danh mục bài viết
            $table->unsignedBigInteger('author_id'); // ID tác giả
            $table->enum('status', ['draft', 'published'])->default('draft'); // Trạng thái
            $table->timestamps();
    
            $table->foreign('post_category_id')->references('id')->on('post_categories')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
