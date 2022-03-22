<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class WeatherLocation extends Model
{
    use HasFactory;
    protected $fillable = ['city', 'longitude', 'latitude'];

    public function fetchWeatherFromOpenWeatherMapForThisLocation($dateInUnix){
        $result = Http::get(config('app.openweathermap_url').'/onecall/timemachine',[
            'lat' => $this->latitude,
            'lon' => $this->longitude,
            'dt' => $dateInUnix,
            'appid' => config('app.openweathermap_token')
        ]);
        return $result->json();
    }
    public function weatherDays(){
        return $this->hasMany(WeatherForecast::class);
    }

    public function createOrUpdateWeatherForDay(Carbon $day){
        $dataFromApi = $this->fetchWeatherFromOpenWeatherMapForThisLocation($day->timestamp);

        $weatherData = $dataFromApi['current'];

        $weatherForecast = $this->weatherDays()->where('date', $day->toDateString());

        if($weatherForecast->count() > 0){
            $weatherForecast = $weatherForecast->first();
        }else{
            $weatherForecast = new WeatherForecast();
            $weatherForecast->weather_location_id = $this->id;
            $weatherForecast->date = $day;
        }

        $weatherForecast->dt = $weatherData['dt'];
        $weatherForecast->sunrise = $weatherData['sunrise'];
        $weatherForecast->sunset = $weatherData['sunset'];
        $weatherForecast->temp = $weatherData['temp'];
        $weatherForecast->feels_like = $weatherData['feels_like'];
        $weatherForecast->pressure = $weatherData['pressure'];
        $weatherForecast->humidity = $weatherData['humidity'];
        $weatherForecast->dew_point = $weatherData['dew_point'];
        $weatherForecast->uvi = $weatherData['uvi'];
        $weatherForecast->clouds = $weatherData['clouds'];
        $weatherForecast->visibility = $weatherData['visibility'];
        $weatherForecast->wind_speed = $weatherData['wind_speed'];
        $weatherForecast->wind_deg = $weatherData['wind_deg'];
        $weatherForecast->wind_gust = $weatherData['wind_gust'] ?? null;

        $weatherForecast->save();
        foreach ($weatherData['weather'] as $weather){
            $weatherForecastWeather = $weatherForecast->weather()->where('api_id', $weather['id']);
            if($weatherForecastWeather->count() > 0){
                $weatherForecastWeather = $weatherForecastWeather->first();
            }else{
                $weatherForecastWeather = new WeatherForecastWeather();
                $weatherForecastWeather->weather_forecast_id = $weatherForecast->id;
                $weatherForecastWeather->api_id = $weather['id'];
            }
            $weatherForecastWeather->main = $weather['main'];
            $weatherForecastWeather->description = $weather['description'];
            $weatherForecastWeather->icon = $weather['icon'];
            $weatherForecastWeather->save();
        }
        return $weatherForecast;
    }
}
