<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genders = [
            'Male',
            'Female'
        ];

        foreach($genders as $gender) {

            Gender::firstOrCreate(
                [ "name" => $gender],
                [ "name" => $gender]
            );
        }
    }
}
