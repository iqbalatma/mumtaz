<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todos\StoreTodoRequest;
use App\Http\Requests\Todos\UpdateTodoRequest;
use App\Services\TodoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * Use to show all data toto
     *
     * @param TodoService $service
     * @return Response|RedirectResponse
     */
    public function index(TodoService $service): Response|RedirectResponse
    {
        $response = $service->getAllData();
        if ($this->isError($response, route("index"))) return $this->getErrorResponse();
        viewShare($response);
        return response()->view("todos.index");
    }


    /**
     * Use to add new data
     *
     * @param TodoService $service
     * @param StoreTodoRequest $request
     * @return RedirectResponse
     */
    public function store(TodoService $service, StoreTodoRequest $request): RedirectResponse
    {
        $response = $service->addNewData($request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Add new todo successfully"]);
    }

    /**
     * Use to update data todo
     *
     * @param TodoService $service
     * @param UpdateTodoRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(TodoService $service, UpdateTodoRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Update data todo successfully"]);
    }


    /**
     * Use to delete data todo
     *
     * @param TodoService $service
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(TodoService $service, int $id): RedirectResponse
    {
        $response = $service->deleteDataById($id);

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with(["success" => "Delete data todo successfully"]);
    }
}
