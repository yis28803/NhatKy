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
        Schema::create('diary_english', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diary_id')->constrained('diary')->onDelete('cascade'); // Khóa ngoại
            $table->boolean('learned'); // Đánh dấu việc học
            $table->enum('study_duration', ['<1_hour', '1-3_hours', '>3_hours'])->nullable(); // Thời gian học
            $table->string('reason_not_study')->nullable(); // Lý do không học
            $table->string('remedial_action')->nullable(); // Hành động khắc phục
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diary_english');
    }
};
