<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <title>Cập Nhật Nhật Ký</title>
</head>
<body>
    <div class="site-container">
        <h1>Cập Nhật Nhật Ký</h1>
    
        <form action="{{ route('diary.update', $diary->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <label id="date-label" for="date">Ngày tháng:</label>
            <input type="datetime-local" name="created_at" id="created_at" value="{{ $diary->date }}" required><br><br>
    
            <label id="content-label" for="content">Nội dung hôm nay:</label>
            <textarea name="content" id="content" rows="3" required>{{ $diary->content }}</textarea><br><br>
    
            <label id="tasks_tomorrow-label" for="tasks_tomorrow">Việc cần làm ngày mai:</label>
            <textarea name="tasks_tomorrow" id="tasks_tomorrow" rows="3">{{ $diary->tasks_tomorrow }}</textarea><br><br>
    
            <label id="future_plans-label" for="future_plans">Kế hoạch tương lai:</label>
            <textarea name="future_plans" id="future_plans" rows="3">{{ $diary->future_plans }}</textarea><br><br>
    
            <label id="learned_english-label" for="learned_english">Hôm nay có học tiếng Anh không?</label>
            <select name="learned_english" id="learned_english" onchange="toggleEnglishDetails(this.value)">
                <option value="">Chọn</option>
                <option value="1" {{ $diaryEnglish && $diaryEnglish->learned ? 'selected' : '' }}>Có</option>
                <option value="0" {{ $diaryEnglish && !$diaryEnglish->learned ? 'selected' : '' }}>Không</option>
            </select><br><br>
    
            <div id="english_details" style="display: none;">
                <div id="study_duration_section" style="display: none;">
                    <label>Học bao lâu:</label><br>
                    <input type="radio" name="study_duration" value="<1_hour" {{ $diaryEnglish && $diaryEnglish->study_duration === '<1_hour' ? 'checked' : '' }}> Dưới 1 giờ<br>
                    <input type="radio" name="study_duration" value="1-3_hours" {{ $diaryEnglish && $diaryEnglish->study_duration === '1-3_hours' ? 'checked' : '' }}> 1-3 giờ<br>
                    <input type="radio" name="study_duration" value=">3_hours" {{ $diaryEnglish && $diaryEnglish->study_duration === '>3_hours' ? 'checked' : '' }}> Hơn 3 giờ<br><br>
                </div>
    
                <div id="not_study_section" style="display: none;">
                    <label id="reason_not_study-label" for="reason_not_study">Lý do không học:</label>
                    <input type="text" name="reason_not_study" id="reason_not_study" value="{{ $diaryEnglish ? $diaryEnglish->reason_not_study : '' }}"><br><br>
    
                    <label id="remedial_action-label" for="remedial_action">Hành động khắc phục:</label>
                    <input type="text" name="remedial_action" id="remedial_action" value="{{ $diaryEnglish ? $diaryEnglish->remedial_action : '' }}"><br><br>
                </div>
            </div>
    
            <button type="submit">Cập Nhật Nhật Ký</button>
        </form>
    
        <form action="{{ route('diary.index') }}" method="GET" style="display:inline;">
            <button type="submit" class="btn btn-secondary btn-sm">Quay lại</button>
        </form>
    </div>
    
    <script>
        function toggleEnglishDetails(value) {
            const studyDuration = document.getElementById('study_duration_section');
            const notStudySection = document.getElementById('not_study_section');
            const englishDetails = document.getElementById('english_details');

            if (value === "1") {
                studyDuration.style.display = "block";
                notStudySection.style.display = "none";
            } else if (value === "0") {
                studyDuration.style.display = "none";
                notStudySection.style.display = "block";
            }
            englishDetails.style.display = value ? "block" : "none";
        }

        toggleEnglishDetails("{{ $diaryEnglish ? $diaryEnglish->learned : '' }}");
    </script>
</body>
</html>
