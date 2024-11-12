<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Nhật Ký</title>
    <link rel="stylesheet" href="{{ asset('css/create_daily_tasks.css') }}">
</head>
<body>
    <div class="site-container">
        <h1>Thêm Công Việc Mới</h1>
        <form action="{{ route('daily_tasks.store') }}" method="POST">
            @csrf
            <label for="title" class="label-title">Tên Công Việc:</label>
            <input type="text" name="title" id="title" required>

            <label for="description" class="label-description">Mô Tả:</label>
            <textarea name="description" id="description"></textarea>

            <button type="submit">Lưu</button>
        </form>
        <form action="{{ route('daily_tasks.index') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn btn-secondary btn-sm">Quay lại</button>
        </form>
    </div>
</body>
</html>
