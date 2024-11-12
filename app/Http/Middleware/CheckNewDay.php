<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\DailyTask;
use Carbon\Carbon;

class CheckNewDay
{
    public function handle(Request $request, Closure $next)
    {
        // Lấy giá trị ngày cuối cùng đã reset từ cache
        $lastResetDate = Cache::get('last_reset_date');
        $currentDate = Carbon::now()->toDateString();

        // Kiểm tra nếu ngày hiện tại khác với ngày cuối cùng đã reset
        if ($lastResetDate !== $currentDate) {
            // Cập nhật trạng thái các công việc về 'incomplete'
            DailyTask::where('status', '!=', 'incomplete')->update(['status' => 'incomplete']);

            // Lưu lại ngày hôm nay vào cache để làm mốc
            Cache::put('last_reset_date', $currentDate);

            // Ghi lại nhật ký để kiểm tra
            Log::info('Đã cập nhật trạng thái về "incomplete" vào ngày mới: ' . $currentDate);
        }

        return $next($request);
    }
}
