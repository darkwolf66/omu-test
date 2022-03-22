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
        Schema::create('weather_forecast_weather', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\WeatherForecast::class);
            $table->bigInteger('api_id');
            $table->unique(['api_id', 'weather_forecast_id']);
            $table->string('main');
            $table->string('description');
            $table->string('icon');

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
        Schema::dropIfExists('weather_forecast_weather');
    }
};
