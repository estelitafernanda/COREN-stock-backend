<?php

namespace Database\Seeders;

use App\Models\Response;
use Illuminate\Database\Seeder;

class ResponseSeeder extends Seeder
{
    public function run()
    {
        Response::factory(15)->create();
    }
}
