<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit_task.css') }}">
    <title>Chỉnh Sửa Công Việc</title>
</head>
<body>
    <div class="edit-task-container">
        <h1>Chỉnh Sửa Công Việc</h1>

        <form action="{{ route('future_work.update', $futureWork->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="label-must-do" for="must_do">Phải làm:</label><br>
            <textarea name="must_do" id="must_do" rows="4" required>{{ $futureWork->must_do }}</textarea><br><br>

            <label class="label-want-to-do" for="want_to_do">Muốn làm:</label><br>
            <textarea name="want_to_do" id="want_to_do" rows="4" required>{{ $futureWork->want_to_do }}</textarea><br><br>

            <label class="label-need-to-do" for="need_to_do">Cần làm:</label><br>
            <textarea name="need_to_do" id="need_to_do" rows="4" required>{{ $futureWork->need_to_do }}</textarea><br><br>

            <button type="submit">Cập nhật</button>
        </form>

        <form action="{{ route('future_work.index') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn btn-secondary btn-sm">Quay lại</button>
        </form>
    </div>
</body>
</html>
