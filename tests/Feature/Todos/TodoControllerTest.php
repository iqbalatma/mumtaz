<?php

namespace Tests\Feature\Todos;

use App\Models\Project;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TodoControllerTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route("todos.index"));
        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    public function testStore()
    {
        $user = User::create([
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => Hash::make("admin"),
        ]);
        $project = Project::create([
            "name" => "project",
            "user_id" => $user->id
        ]);
        $requestTodo = [
            "name" => "new todo",
            "project_id" => $project->id,
        ];
        $response = $this->post(route("todos.store"), $requestTodo);
        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertSessionHas("success", "Add new todo successfully");
    }

    public function testUpdate()
    {
        $user = User::create([
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => Hash::make("admin"),
        ]);
        $project = Project::create([
            "name" => "project",
            "user_id" => $user->id
        ]);
        $todo = Todo::create([
            "name" => "new todo",
            "project_id" => $project->id,
        ]);

        $updatedTodo = [
            "name" => "updated todo",
            "project_id" => $project->id,
            "body" => "New comment"
        ];
        $response = $this->put(route("todos.update", $todo->id), $updatedTodo);
        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertSessionHas("success", "Update data todo successfully");
    }

    public function testDestroy()
    {
        $user = User::create([
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => Hash::make("admin"),
        ]);
        $project = Project::create([
            "name" => "project",
            "user_id" => $user->id
        ]);
        $todo = Todo::create([
            "name" => "new todo",
            "project_id" => $project->id,
        ]);

        $response = $this->delete(route("todos.destroy", $todo->id));
        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertSessionHas("success", "Delete data todo successfully");
    }
}
