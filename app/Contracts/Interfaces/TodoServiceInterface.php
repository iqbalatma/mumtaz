<?php

namespace App\Contracts\Interfaces;

interface TodoServiceInterface
{
    public function getAllData(): array;
    public function addNewData(array $requestedData): array;
}
