<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_forecasts', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->index('date');
            $table->foreignIdFor(\App\Models\WeatherLocation::class);
            $table->unique(['date', 'weather_location_id']);

            $table->integer('dt');
            $table->integer('sunrise');
            $table->integer('sunset');
            $table->float('temp');
            $table->float('feels_like');
            $table->float('pressure');
            $table->float('humidity');
            $table->float('dew_point');
            $table->float('uvi');
            $table->float('clouds');
            $table->float('visibility');
            $table->float('wind_speed');
            $table->float('wind_deg');
            //Detected possibility to be null
            $table->float('wind_gust')->nullable(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weather_forecasts');
    }
};
