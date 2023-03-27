<?php

namespace App\Services;

use App\Contracts\Interfaces\TodoServiceInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\TodoRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;

class TodoService extends BaseService implements TodoServiceInterface
{
    protected $repository;
    protected $projectRepo;

    public function __construct()
    {
        $this->repository = new TodoRepository();
        $this->projectRepo = new ProjectRepository();
    }

    /**
     * Use to show all data for index view
     *
     * @return array
     */
    public function getAllData(): array
    {
        try {
            $todos = $this->repository->orderBy(["id"], "id", "DESC")->getAllDataPaginated();
            $response = [
                "success" => true,
                "title" => "Todo",
                "todos" => $todos,
                "projects" => $this->projectRepo->getAllData()
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
}
