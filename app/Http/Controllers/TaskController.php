<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateTaskAction;
use App\Actions\Task\UpdateTaskAction;
use App\DTO\TaskData;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $tasks = Task::query()
            ->select('tasks.*', 'users.name', 'users.email')
            ->join('users', 'users.id', '=', 'tasks.user_id')
            ->when($request->get('param') && $request->get('sort'), function (Builder $query) use ($request) {
                $query->orderBy($request->get('param'), $request->get('sort'));
            })
            ->paginate(3);

        return response()->json([
            'data' => $tasks
        ]);
    }

    public function store(TaskRequest $request, CreateTaskAction $createTaskAction)
    {
        $dto = TaskData::from($request->all());

        $createTaskAction->execute($dto);

        return response()->json([
            'data' => [],
            'success' => true
        ]);

    }

    public function update(Task $task, TaskRequest $request, UpdateTaskAction $updateTaskAction)
    {
        $dto = TaskData::from($request->all());

        $updateTaskAction->execute($task, $dto);

        return response()->json([
            'data' => [],
            'success' => true
        ]);

    }

    public function setDone(Task $task)
    {
        $task->done();

        return response()->json([
            'data' => [],
            'success' => true
        ]);
    }


}
