<?php

namespace App\Actions\Task;

use App\Actions\User\CreateUserAction;
use App\DTO\TaskData;
use App\DTO\UserData;
use App\Models\Task;
use App\Models\User;

class CreateTaskAction
{
    public function __construct(private CreateUserAction $createUserAction)
    {
    }

    public function execute(TaskData $createTaskData)
    {
        $userDto = new UserData(
            name: $createTaskData->getName(),
            email: $createTaskData->getEmail(),
            password: User::DEFAULT_PASSWORD);

        $user = $this->createUserAction->execute($userDto);

        $task = new Task();
        $task->description = $createTaskData->getDescription();
        $task->user_id = $user->id;
        $task->save();

        return $task;
    }
}
