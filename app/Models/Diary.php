<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diary extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'diary';

    protected $fillable = [
        'content',
        'tasks_tomorrow',
        'learned_english',
        'future_plans',
        'created_at',
    ];

    public function diaryEnglish()
    {
        return $this->hasMany(DiaryEnglish::class);
    }
}
