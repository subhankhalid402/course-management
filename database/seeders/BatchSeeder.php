<?php

namespace Database\Seeders;

use App\Models\Batch;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batches = [
            [
                'title' => '01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        Batch::insert($batches);
    }
}
