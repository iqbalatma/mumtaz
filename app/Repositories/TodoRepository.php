<?php

namespace App\Repositories;

use App\Models\Todo;
use Iqbalatma\LaravelServiceRepo\BaseRepository;


class TodoRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Todo();
    }
}
