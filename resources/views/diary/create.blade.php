<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <title>Thêm Nhật Ký</title>
</head>
<body>
    <div class="site-container">
        <h1>Thêm Nhật Ký Mới</h1>
        <form action="{{ route('diary.store') }}" method="POST">
            @csrf
            <label id="date-label" for="date">Ngày tháng:</label>
            <input type="datetime-local" name="created_at" id="created_at" required><br><br>

            <label id="content-label" for="content">Nội dung hôm nay:</label>
            <textarea name="content" id="content" rows="3" required></textarea><br><br>

            <label id="tasks_tomorrow-label" for="tasks_tomorrow">Việc cần làm ngày mai:</label>
            <textarea name="tasks_tomorrow" id="tasks_tomorrow" rows="3" required></textarea><br><br>

            <label id="future_plans-label" for="future_plans">Kế hoạch tương lai:</label>
            <textarea name="future_plans" id="future_plans" rows="3"></textarea><br><br>

            <label id="learned_english-label" for="learned_english">Hôm nay có học tiếng Anh không?</label>
            <select name="learned_english" id="learned_english" onchange="toggleEnglishDetails(this.value)">
                <option value="">Chọn</option>
                <option value="1">Có</option>
                <option value="0">Không</option>
            </select><br><br>

            <div id="english_details" style="display: none;">
                <div id="study_duration_section" style="display: none;">
                    <label>Học bao lâu:</label><br>
                    <input type="radio" name="study_duration" value="<1_hour"> Dưới 1 giờ<br>
                    <input type="radio" name="study_duration" value="1-3_hours"> 1-3 giờ<br>
                    <input type="radio" name="study_duration" value=">3_hours"> Hơn 3 giờ<br><br>
                </div>

                <div id="not_study_section" style="display: none;">
                    <label id="reason_not_study-label" for="reason_not_study">Lý do không học:</label>
                    <input type="text" name="reason_not_study" id="reason_not_study"><br><br>

                    <label id="remedial_action-label" for="remedial_action">Hành động khắc phục:</label>
                    <input type="text" name="remedial_action" id="remedial_action"><br><br>
                </div>
            </div>

            <button type="submit">Lưu Nhật Ký</button>
            
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
    </script>
</body>
</html>
