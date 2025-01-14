<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    public function run()
    {
        Request::factory(15)->create();
    }
}

