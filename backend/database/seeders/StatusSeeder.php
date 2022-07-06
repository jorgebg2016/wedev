<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            "Open",
            "Paid",
            "Canceled"
        ];

        foreach($status as $item) {

            Status::firstOrCreate(
                [ "name" => $item],
                [ "name" => $item]
            );
        }
    }
}
