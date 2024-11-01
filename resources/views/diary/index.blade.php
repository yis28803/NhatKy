<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Danh Sách Nhật Ký</title>
</head>
<body>
    <div class="site-container">
        <h1>Nhật Ký</h1>
        <div style="display: flex; gap: 10px;">
            <form action="{{ route('diary.create') }}" method="GET">
                <button type="submit" class="btn btn-primary btn-sm">Thêm Nhật Ký Mới</button>
            </form>
            <form action="{{ route('diary.english-journey') }}" method="GET">
                <button type="submit" class="btn btn-info btn-sm">Xem Hành Trình Học Tiếng Anh</button>
            </form>
            <form action="{{ route('future_work.index') }}" method="GET">
                <button type="submit" class="btn btn-success btn-sm">Xem Công Việc Tương Lai</button>
            </form>
        </div>    
        <h2 class="today">Nhật ký hôm nay</h2>
        @forelse ($todayDiary as $diary)
            <p>{{ $diary->created_at }}: {{ $diary->content }}</p>
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="{{ route('diary.edit', $diary->id) }}" method="GET">
                    <button type="submit" class="btn btn-warning btn-sm">Cập nhật</button>
                </form>
                <form action="{{ route('diary.destroy', $diary->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </div>
        @empty
            <p>Không có nhật ký nào cho hôm nay.</p>
        @endforelse
        <h2 class="future">Nhật ký tương lai</h2>
        @forelse ($futureDiary as $diary)
            <p>{{ $diary->created_at }}: {{ $diary->content }}</p>
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="{{ route('diary.edit', $diary->id) }}" method="GET">
                    <button type="submit" class="btn btn-warning btn-sm">Cập nhật</button>
                </form>
                <form action="{{ route('diary.destroy', $diary->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </div>
        @empty
            <p>Không có nhật ký nào trong tương lai.</p>
        @endforelse
        <h2 class="past">Nhật ký quá khứ</h2>
        @forelse ($pastDiary as $diary)
            <p>{{ $diary->created_at }}: {{ $diary->content }}</p>
            <div style="display: flex; gap: 10px; align-items: center;">
                <form action="{{ route('diary.edit', $diary->id) }}" method="GET">
                    <button type="submit" class="btn btn-warning btn-sm">Cập nhật</button>
                </form>
                <form action="{{ route('diary.destroy', $diary->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                </form>
            </div>
        @empty
            <p>Không có nhật ký nào trong quá khứ.</p>
        @endforelse
    </div>
</body>
</html>
