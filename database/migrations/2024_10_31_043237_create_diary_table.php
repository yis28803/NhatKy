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
        Schema::create('diary', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();          // Nội dung nhật ký hôm nay
            $table->text('tasks_tomorrow')->nullable();    // Việc cần làm cho ngày mai
            $table->boolean('learned_english')->default(false); // Đánh dấu học tiếng Anh
            $table->text('future_plans')->nullable();      // Kế hoạch trong tương lai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary');
    }
};
