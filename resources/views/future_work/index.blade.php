<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/future_work.css') }}">
    <title>Danh Sách Công Việc Tương Lai</title>
</head>
<body>
    <div class="task-container">
        <h1>Danh Sách Công Việc Tương Lai</h1>

        <div class="task-item">
            <div class="task-label must-do">Phải làm:</div>
            <ul class="task-content">
                @foreach(explode("\n", $futureWorkTask->must_do) as $task)
                    <li>{{ $task }}</li>
                @endforeach
            </ul>
        </div>

        <div class="task-item">
            <div class="task-label want-to-do">Muốn làm:</div>
            <ul class="task-content">
                @foreach(explode("\n", $futureWorkTask->want_to_do) as $task)
                    <li>{{ $task }}</li>
                @endforeach
            </ul>
        </div>

        <div class="task-item">
            <div class="task-label need-to-do">Cần làm:</div>
            <ul class="task-content">
                @foreach(explode("\n", $futureWorkTask->need_to_do) as $task)
                    <li>{{ $task }}</li>
                @endforeach
            </ul>
        </div>

        <div class="task-actions">
            <form action="{{ route('future_work.edit', $futureWorkTask->id) }}" method="GET" style="display:inline;">
                <button type="submit" style="background-color: #4CAF50; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 5px;">Chỉnh sửa</button>
            </form>
            <form action="{{ route('diary.index') }}" method="GET" style="display:inline;">
                <button type="submit" style="background-color: #2196F3; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 5px;">Quay lại</button>
            </form>
        </div>
    </div>
</body>
</html>
