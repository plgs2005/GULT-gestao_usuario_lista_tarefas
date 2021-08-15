<?php

namespace Database\Seeders;

use App\Models\TasksStatus;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TasksStatus::create(
            ['status' => 'CANCELADO'],   
        );
        TasksStatus::create(
            ['status' => 'ANDAMENTO'],   
        );
        TasksStatus::create(
            ['status' => 'CONCLUÍDO'],   
        );
    }
}
