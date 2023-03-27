<?php
namespace App\Repositories;
use App\Models\User;
use Iqbalatma\LaravelServiceRepo\BaseRepository;

class UserRepository extends BaseRepository{
    protected $model;

    public function __construct() {
        $this->model = new User();
    }

}
