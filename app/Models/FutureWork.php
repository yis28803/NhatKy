<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class FutureWork extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu không theo quy tắc mặc định
    protected $table = 'future_work';

    // Các thuộc tính có thể được gán hàng loạt
    protected $fillable = [
        'need_to_do',
        'must_do',
        'want_to_do',
    ];
}
