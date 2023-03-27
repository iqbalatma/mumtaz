<?php

namespace App\Repositories;

use App\Models\Project;
use Iqbalatma\LaravelServiceRepo\BaseRepository;


class ProjectRepository extends BaseRepository
{

    protected $model;

    public function __construct()
    {
        $this->model = new Project();
    }
}
