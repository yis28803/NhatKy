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
        Schema::create('future_work', function (Blueprint $table) {
            $table->id();
            $table->string('must_do');          // Công việc  Phải làm
            $table->string('want_to_do');      // Muốn làm
            $table->string('need_to_do');     // Cần làm 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('future_work');
    }
};
