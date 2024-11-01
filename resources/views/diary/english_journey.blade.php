<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hành Trình Học Tiếng Anh</title>
    <link rel="stylesheet" href="{{ asset('css/english_journey.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="site-container">
        <h1>Hành Trình Học Tiếng Anh</h1>
        <form action="{{ route('diary.index') }}" method="GET" style="display: flex; flex-direction: column; align-items: center;">
            <button type="submit" class="btn btn-secondary btn-sm">Quay lại</button>
        </form>
        <br>

        <form id="dateFilterForm" action="{{ route('diary.english-journey') }}" method="GET" style="display: flex; justify-content: center; margin-bottom: 20px;">
            <label for="startDate">Từ ngày:</label>
            <input type="date" name="startDate" id="startDate" required>
            
            <label for="endDate">Đến ngày:</label>
            <input type="date" name="endDate" id="endDate" required>
            
            <button type="submit">Lọc</button>
        </form>
        

        <h2>Biểu Đồ Thời Gian Học</h2>
        <canvas id="studyDurationChart" width="400" height="200"></canvas>

        <h2>Chi Tiết Học Tiếng Anh</h2>
        @foreach ($englishJourney as $index => $journey)
            <div style="text-align: {{ $journey->learned ? 'center' : 'left' }};">
                <p>
                    <strong class="color-{{ $index % 5 }}">Ngày:</strong> 
                    {{ $journey->created_at }}
                </p>
                @if ($journey->learned !== null) <!-- Kiểm tra xem đã học có giá trị không -->
                    <p>
                        <strong class="color-{{ $index % 5 }}">Đã học:</strong> 
                        {{ $journey->learned ? 'Có' : 'Không' }}
                    </p>
                @endif
                @if (!empty($journey->study_duration)) <!-- Kiểm tra xem thời gian học có giá trị không -->
                    <p>
                        <strong class="color-{{ $index % 5 }}">Thời gian học:</strong> 
                        {{ $journey->study_duration }}
                    </p>
                @endif
                @if (!empty($journey->reason_not_study)) <!-- Kiểm tra lý do không học -->
                    <p>
                        <strong class="color-{{ $index % 5 }}">Lý do không học:</strong> 
                        {{ $journey->reason_not_study }}
                    </p>
                @endif
                @if (!empty($journey->remedial_action)) <!-- Kiểm tra hành động khắc phục -->
                    <p>
                        <strong class="color-{{ $index % 5 }}">Hành động khắc phục:</strong> 
                        {{ $journey->remedial_action }}
                    </p>
                @endif
                <hr>
            </div>
        @endforeach

    </div>

    
    <script>
        const ctx = document.getElementById('studyDurationChart').getContext('2d');
        
        const dates = @json(array_keys($dates));
        const chartData = @json($dates);
        const studyDurationLabels = @json($studyDurationLabels);

        const datasets = studyDurationLabels.map((label, index) => ({
            label: label,
            data: dates.map(date => chartData[date][label]),
            borderColor: [
                'rgba(54, 162, 235, 1)', 
                'rgba(75, 192, 192, 1)', 
                'rgba(255, 99, 132, 1)', 
                'rgba(201, 203, 207, 1)'
            ][index],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)', 
                'rgba(75, 192, 192, 0.2)', 
                'rgba(255, 99, 132, 0.2)', 
                'rgba(201, 203, 207, 0.2)'
            ][index],
            borderWidth: 2,
            fill: false
        }));

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: datasets
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Số lần học'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Ngày'
                        }
                    }
                },
                responsive: false,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>
</html>
