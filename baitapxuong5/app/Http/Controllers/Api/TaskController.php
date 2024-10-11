<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        return $project->tasks;
    }

    public function store(Request $request, Project $project)
    {
        try {
            $task = $project->tasks()->create($request->validate([
                'task_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|string|in:Chưa bắt đầu,Đang thực hiện,Đã hoàn thành',
            ]));

            return response()->json(['message' => 'Nhiệm vụ được tạo thành công', 'task' => $task], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Có lỗi xảy ra: ' . $e->getMessage()], 500);
        }
    }
    public function show(Project $project, Task $task)
    {
        return $task;
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $task->update($request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:Chưa bắt đầu,Đang thực hiện,Đã hoàn thành',
        ]));



        return response()->json(['message' => 'Nhiệm vụ được cập nhật', 'task' => $task]);
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Nhiệm vụ được xóa']);
    }
}
