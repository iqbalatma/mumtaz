<?php

namespace App\Http\Controllers;

use App\Http\Requests\Todos\StoreTodoRequest;
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
}
