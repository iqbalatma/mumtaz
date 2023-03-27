<?php

namespace App\Http\Controllers;

use App\Enums\Statuses;
use App\Models\Tag;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        dd(Todo::with("tag")->find(1));
        dd(User::with(["project", "todo"])->find(1));
        dd(Statuses::cases());
        dd("tes");
    }
}
