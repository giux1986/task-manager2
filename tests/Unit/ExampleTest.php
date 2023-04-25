<?php

namespace Tests\Unit;

use App\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a task.
     *
     * @return void
     */
    public function test_create_task()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Task',
        ]);

        $this->assertEquals('Test Task', $task->title);
        $this->assertTrue($user->tasks->contains($task));
    }

    /**
     * Test updating a task.
     *
     * @return void
     */
    public function test_update_task()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Task',
        ]);

        $task->title = 'Updated Test Task';
        $task->save();

        $this->assertEquals('Updated Test Task', $task->title);
    }

    /**
     * Test deleting a task.
     *
     * @return void
     */
    public function test_delete_task()
    {
        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Task',
        ]);

        $task->delete();

        $this->assertDeleted($task);
    }
}
