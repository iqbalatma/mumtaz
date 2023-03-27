<?php

namespace App\Http\Controllers;

use App\Enums\Statuses;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        dd(Statuses::cases());
        dd("tes");
    }
}
