<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit_daily_tasks.css') }}">
    <title>Danh Sách Nhật Ký</title>
</head>
<body>
    <div class="site-container">
        <h1>Chỉnh Sửa Công Việc</h1>
        <form action="{{ route('daily_tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Áp dụng lớp màu cho từng label -->
            <label for="title" class="label-title">Tên Công Việc:</label>
            <input type="text" name="title" id="title" value="{{ $task->title }}" required>

            <label for="description" class="label-description">Mô Tả:</label>
            <textarea name="description" id="description">{{ $task->description }}</textarea>

            <label for="status" class="label-status">Trạng Thái:</label>
            <select name="status" id="status">
                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Hoàn Thành</option>
                <option value="incomplete" {{ $task->status == 'incomplete' ? 'selected' : '' }}>Không Hoàn Thành</option>
            </select>

            <button type="submit">Lưu</button>
        </form>
        <form action="{{ route('daily_tasks.index') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn btn-secondary btn-sm">Quay lại</button>
        </form>
    </div>
</body>
</html>
