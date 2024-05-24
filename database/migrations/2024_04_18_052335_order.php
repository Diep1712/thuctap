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
        Schema::table('orders', function (Blueprint $table) {
            // Thêm các trường mới từ bảng displaypd
            $table->unsignedInteger('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->unsignedInteger('quantity')->nullable();

            // Thêm các trường khác
            $table->string('ten');
            $table->string('dia_chi');
            $table->string('so_dien_thoai');
            $table->string('san_pham_da_mua');
            $table->decimal('tong_thanh_toan', 10, 2); // Tổng thanh toán có thể là kiểu dữ liệu decimal
            $table->string('phuong_thuc_thanh_toan');
            $table->string('email')->unique();
            // Các cột khác có thể được thêm vào bảng tại đây
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Xóa các trường mới
            $table->dropColumn(['product_id', 'product_name', 'quantity']);

            // Xóa các trường khác nếu cần
            $table->dropColumn(['ten', 'dia_chi', 'so_dien_thoai', 'san_pham_da_mua', 'tong_thanh_toan', 'phuong_thuc_thanh_toan', 'email']);
            // Xóa các cột khác nếu cần
        });
    }
};
