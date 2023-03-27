<?php

namespace Database\Seeders;

use App\Enums\Statuses;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Status::truncate();
        Schema::enableForeignKeyConstraints();
        foreach (Statuses::cases() as $key => $value) {
            Status::create(["name" => $value->name]);
        }
    }
}
