<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tasks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        // Only admins can view all tasks
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        // Only admins or the task's owner can view the task
        return $user->isAdmin() || $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Any authenticated user can create a task
        return $user->id !== null;
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        // Only admins or the task's owner can update the task
        return $user->isAdmin() || $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        // Only admins or the task's owner can delete the task
        return $user->isAdmin() || $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can mark the task as completed.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function complete(User $user, Task $task)
    {
        // Only the task's owner can mark the task as completed
        return $user->id === $task->user_id;
    }
}
