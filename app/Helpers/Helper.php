<?php

use Illuminate\Support\Facades\View;


function viewShare(array $data): void
{
    foreach ($data as $key => $value) {
        View::share($key, $value);
    }
}
