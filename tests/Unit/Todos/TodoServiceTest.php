<?php

namespace Tests\Unit\Todos;

use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpParser\ErrorHandler\Collecting;
use Tests\TestCase;

class TodoServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllData()
    {
        $response = (new TodoService())->getAllData();
        $this->assertIsArray($response);
        $this->assertTrue($response["success"]);
        $this->assertEquals($response["title"], "Todo");
        $this->assertInstanceOf(LengthAwarePaginator::class, $response["todos"]);
        $this->assertInstanceOf(Collection::class, $response["projects"]);
    }
    public function testAddNewData()
    {
        $request = [
            "name" => fake()->name(),
            "project_id" => 1
        ];
        $response = (new TodoService())->addNewData($request);
        $this->assertTrue($response["success"]);
    }

    public function testUpdateById()
    {
        $todo = Todo::create([
            "name" => fake()->name(),
            "project_id" => 1
        ]);

        $updated =  [
            "name" => "updated todo",
            "project_id" => 1
        ];
        $response = (new TodoService())->updateDataById($todo->id, $updated);
        $this->assertTrue($response["success"]);
    }

    public function testDeleteById()
    {
        $todo = Todo::create([
            "name" => fake()->name(),
            "project_id" => 1
        ]);

        $response = (new TodoService())->deleteDataById($todo->id);
        $this->assertTrue($response["success"]);
    }
}
