<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary;
use App\Models\DiaryEnglish;
use App\Models\FutureWork;


class DiaryController extends Controller
{
    public function index()
    {
        $today = now()->startOfDay();
        $tomorrow = now()->endOfDay();

        $todayDiary = Diary::whereBetween('created_at', [$today, $tomorrow])->get();
        $futureDiary = Diary::where('created_at', '>', $tomorrow)->get();
        $pastDiary = Diary::where('created_at', '<', $today)->get();

        return view('diary.index', compact('todayDiary', 'futureDiary', 'pastDiary'));
    }


    public function create()
    {
        return view('diary.create');
    }

    public function store(Request $request)
    {
       $diary = Diary::create($request->only(['content', 'tasks_tomorrow', 'learned_english', 'future_plans', 'created_at']));

       if ($request->filled('learned_english')) {
           DiaryEnglish::create([
               'diary_id' => $diary->id,
               'learned' => $request->learned_english,
               'study_duration' => $request->learned_english ? $request->study_duration : null,
               'reason_not_study' => $request->learned_english ? null : $request->reason_not_study,
               'remedial_action' => $request->learned_english ? null : $request->remedial_action,
               'created_at' => $request->created_at,
           ]);
       }

       return redirect()->route('diary.index');
    }

    public function edit($id)
    {
        $diary = Diary::findOrFail($id);
        $diaryEnglish = DiaryEnglish::where('diary_id', $id)->first();

        return view('diary.edit', compact('diary', 'diaryEnglish'));
    }

    public function update(Request $request, $id)
    {
        $diary = Diary::findOrFail($id);
        $diary->update($request->only(['content', 'tasks_tomorrow', 'learned_english', 'future_plans', 'created_at']));

        if ($request->filled('learned_english')) {
            $diaryEnglish = DiaryEnglish::updateOrCreate(
                ['diary_id' => $diary->id],
                [
                    'learned' => $request->learned_english,
                    'study_duration' => $request->learned_english ? $request->study_duration : null,
                    'reason_not_study' => $request->learned_english ? null : $request->reason_not_study,
                    'remedial_action' => $request->learned_english ? null : $request->remedial_action,
                    'created_at' => $request->created_at,
                ]
            );
        }

        return redirect()->route('diary.index');
    }

    public function destroy($id)
    {
        $diary = Diary::findOrFail($id);
        $diary->delete();

        return redirect()->route('diary.index');
    }

    public function englishJourney(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $englishJourney = DiaryEnglish::with('diary')
            ->when($startDate, function ($query) use ($startDate) {
                return $query->where('created_at', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->where('created_at', '<=', $endDate);
            })
            ->get();

        // Các phần xử lý dữ liệu khác...
        $studyDurationLabels = ['>3_hours', '1-3_hours', '<1_hour', 'NULL'];
        $dates = [];

        foreach ($englishJourney as $journey) {
            $date = $journey->created_at->toDateString();
            $duration = $journey->study_duration ?? 'NULL';

            if (!isset($dates[$date])) {
                $dates[$date] = array_fill_keys($studyDurationLabels, 0);
            }
            $dates[$date][$duration]++;
        }

        return view('diary.english_journey', compact('englishJourney', 'dates', 'studyDurationLabels'));
    }

    public function showFutureWork()
    {
        
        $futureWorkTask = FutureWork::first();
        return view('future_work.index', compact('futureWorkTask'));
    }
    public function editFutureWork($id)
    {
        $futureWork = FutureWork::findOrFail($id);
        return view('future_work.edit', compact('futureWork'));
    }

    public function updateFutureWork(Request $request, $id)
    {
        $request->validate([
            'must_do' => 'required|string|max:255', 
            'want_to_do' => 'required|string|max:255',    
            'need_to_do' => 'required|string|max:255', 
        ]);

        $futureWork = FutureWork::findOrFail($id);
        $futureWork->update($request->all());

        return redirect()->route('future_work.index')->with('success', 'Cập nhật công việc thành công');
    }

    


}
