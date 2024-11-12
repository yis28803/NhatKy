<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyTask extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu không theo quy tắc mặc định
    protected $table = 'daily_tasks';

    protected $fillable = ['title', 'description', 'status', 'reason', 'task_date'];

}
