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
        Schema::create('course_student', function (Blueprint $table) {
            $table->id();
            
            // 外键关联课程
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            
            // 外键关联学生（用户）
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->timestamps();

            // 确保同一个学生不能重复加入同一个课程
            $table->unique(['course_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_student');
    }
};
