<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Công Việc Hằng Ngày</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/index_daily_tasks.css') }}">
</head>
<body>
    <div class="site-container">
        <h1>Danh Sách Công Việc Hằng Ngày</h1>

        <form action="{{ route('daily_tasks.create') }}" method="GET" style="display: inline;">
            <button type="submit" class="btn btn-secondary">Thêm mới</button>
        </form>

        <form action="{{ route('future_work.index') }}" method="GET">
            <button type="submit" class="btn btn-success">Quay lại</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Công việc</th>
                    <th>Trạng thái: Yes / No</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>
                            <label>
                                <input type="radio" name="statuses[{{ $task->id }}]" value="completed"
                                    {{ $task->status == 'completed' ? 'checked' : '' }}
                                    onchange="updateStatus({{ $task->id }}, 'completed')">
                                ✔️ 
                            </label>
                            <label>
                                <input type="radio" name="statuses[{{ $task->id }}]" value="incomplete"
                                    {{ $task->status == 'incomplete' ? 'checked' : '' }}
                                    onchange="updateStatus({{ $task->id }}, 'incomplete')">
                                ❌ 
                            </label>
                        </td>
                        <td>
                            <form action="{{ route('daily_tasks.edit', $task->id) }}" method="GET">
                                <button type="submit" class="btn btn-warning btn-sm">Cập nhật</button>
                            </form>
                            <form action="{{ route('daily_tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Hàm cập nhật trạng thái bằng AJAX
        function updateStatus(taskId, status) {
            fetch(`/daily_tasks/${taskId}/update_status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Trạng thái đã được cập nhật.");
                } else {
                    console.error("Có lỗi xảy ra khi cập nhật trạng thái.");
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>
