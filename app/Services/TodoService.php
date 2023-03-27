<?php

namespace App\Services;

use App\Contracts\Interfaces\TodoServiceInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\TodoRepository;
use App\Repositories\UserRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;

class TodoService extends BaseService implements TodoServiceInterface
{
    protected $repository;
    protected $projectRepo;
    protected $userRepo;

    public function __construct()
    {
        $this->repository = new TodoRepository();
        $this->projectRepo = new ProjectRepository();
        $this->userRepo = new UserRepository();
    }

    /**
     * Use to show all data for index view
     *
     * @return array
     */
    public function getAllData(): array
    {
        try {
            $todos = $this->repository->with(["project.user", "comment"])->orderBy(["id"], "id", "DESC")->getAllDataPaginated();
            $response = [
                "success" => true,
                "title" => "Todo",
                "todos" => $todos,
                "projects" => $this->projectRepo->getAllData(),
                "users" => $this->userRepo->getAllData()
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => "Something went wrong"
            ];
        }

        return $response;
    }


    /**
     * Use to add new data
     *
     * @param array $requestedData
     * @return array
     */
    public function  addNewData(array $requestedData): array
    {
        try {
            $this->repository->addNewData($requestedData);
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }

        return $response;
    }


    /**
     * Use to update data by id
     *
     * @param integer $id
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);

            $todo = $this->getData();
            $todo->fill($requestedData);
            $todo->comment()->create($requestedData);
            $todo->save();
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }

        return $response;
    }

    public function deleteDataById(int $id): array
    {
        try {
            $this->checkData($id);
            $this->repository->deleteDataById($id);

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }

        return $response;
    }
}
