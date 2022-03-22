<?php

namespace Database\Seeders;

use App\Models\WeatherLocation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Seeded with Wikipedia relative long lat of each city
        WeatherLocation::insert([
            [
                'city' => "new_york",
                'longitude' => "-73.935242",
                'latitude' => "40.730610",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'city' => "london",
                'longitude' => "-0.118092",
                'latitude' => "51.509865",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'city' => "paris",
                'longitude' => "2.349014",
                'latitude' => "48.864716",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'city' => "berlin",
                'longitude' => "13.404954",
                'latitude' => "52.520008",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'city' => "tokyo",
                'longitude' => "139.839478",
                'latitude' => "35.652832",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
