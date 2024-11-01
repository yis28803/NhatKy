<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiaryEnglish extends Model
{
    use HasFactory;

    // Chỉ định tên bảng
    protected $table = 'diary_english';

    protected $fillable = [
        'diary_id',
        'learned',
        'study_duration',
        'reason_not_study',
        'remedial_action',
        'created_at',
    ];

    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }
}
