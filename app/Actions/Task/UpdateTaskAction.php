<?php

namespace App\Actions\Task;

use App\Actions\User\UpdateUserAction;
use App\DTO\TaskData;
use App\DTO\UserData;
use App\Models\Task;

class UpdateTaskAction
{
    public function __construct(
        private UpdateUserAction $updateUserAction,
    )
    {
    }

    public function execute(Task $task, TaskData $taskData
    )
    {
        $user = $task->user;
        $this->updateUserAction->execute($user, new UserData($taskData->getName(), $taskData->getEmail(), $user->password));

        $task->description = $taskData->getDescription();

        $task->save();

    }
}
