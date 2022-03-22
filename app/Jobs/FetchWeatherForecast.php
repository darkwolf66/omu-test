<?php

namespace App\Jobs;

use App\Models\WeatherForecast;
use App\Models\WeatherForecastWeather;
use App\Models\WeatherLocation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchWeatherForecast implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $weatherLocations = WeatherLocation::all();
        foreach ($weatherLocations as &$weatherLocation){
            $weatherLocation->createOrUpdateWeatherForDay(Carbon::now('UTC'));
        }
    }
}
