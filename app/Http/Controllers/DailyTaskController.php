<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyTask;

class DailyTaskController extends Controller
{
    public function index() {
        $tasks = DailyTask::all();
        return view('daily_tasks.index', compact('tasks'));
    }
    
    public function create() {
        return view('daily_tasks.create');
    }
    
    public function store(Request $request) {
        DailyTask::create($request->all());
        return redirect()->route('daily_tasks.index');
    }
    
    public function edit($id) {
        $task = DailyTask::findOrFail($id);
        return view('daily_tasks.edit', compact('task'));
    }
    
    public function update(Request $request, $id) {
        $task = DailyTask::findOrFail($id);
        $task->update($request->all());
        return redirect()->route('daily_tasks.index');
    }
    
    public function destroy($id) {
        DailyTask::destroy($id);
        return redirect()->route('daily_tasks.index');
    }
    
    public function history()
    {
        $tasks = DailyTask::whereNotNull('status')->orderBy('task_date', 'desc')->get();
        return view('daily_tasks.history', compact('tasks'));
    }
    public function updateStatus(Request $request, $id)
    {
        $task = DailyTask::findOrFail($id);
        $task->status = $request->input('status') === 'completed' ? 'completed' : 'incomplete';
        $task->save();

        return response()->json(['success' => true]);
    }
}
