<?php

namespace App\Http\Controllers;

use App\Models\WeatherLocation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function weatherForDay(Request $request, $city, $date = null, $update = null){
        if(!empty($update) && $update != 'update'){
            return response()->json(standardHttpResponse('error', 'Invalid action!'));
        }
        $weatherLocation = WeatherLocation::where('city', $city);
        if($weatherLocation->count() <= 0){
            return response()->json(standardHttpResponse('error', 'Invalid City!'));
        }
        $weatherLocation = $weatherLocation->first();
        if(empty($date)){
            $date = Carbon::now()->toDateString();
        }

        $weatherForADay = $weatherLocation->weatherDays()->where('date', $date);
        if($weatherForADay->count() <= 0 || !empty($update)){
            try {
                $date = Carbon::parse($date);
            }catch (\Exception $e){
                return response()->json(standardHttpResponse('error', "Invalid Date!"));
            }
            if($date->isFuture()){
                return response()->json(standardHttpResponse('error', 'Requested date is in the future'));
            }
            if(Carbon::now()->diffInDays($date) > 5){
                return response()->json(standardHttpResponse('error', 'Requested time is not available'));
            }
            $weatherForADay = $weatherLocation->createOrUpdateWeatherForDay($date);
        }
        return response()->json(standardHttpResponse('success', $weatherForADay->with('weather')->first()));
    }
}
