<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\WeatherRepositoryInterface;
use App\Models\Weather;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class WeatherRepository extends BaseRepository implements WeatherRepositoryInterface
{

    /**
     * @var Weather
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Weather $model
     */
    public function __construct(Weather $model)
    {
        $this->model = $model;
    }


    /**
     * Store weather for specyfic city
     *
     * @param array $data
     * @return bool
     */
    public function store($data): bool
    {
        //prepare list of cites that need to be updated or add to database
        $cities = $this->model->whereIn('city', $data['cities'])->where('updated_at', Carbon::now())->pluck('city')->toArray();
        $citiesToSave = array_diff($data['cities'], $cities);

        foreach ($citiesToSave as $city) {
            $acctualTemp = $this->getWeatherFromApi($city);

            $this->model->updateOrCreate(
                ['city' => $city],
                ['temp' => $acctualTemp]
            );
        }

        return true;
    }


    /**
     * Get weather for specyfic city from api
     *
     * @param string $city
     * @return float
     */
    public function getWeatherFromApi($city): float
    {

        $api_weather_url = config('weather-api.api_weather_url');
        $api_weather_key = config('weather-api.api_weather_key');

        $response = Http::get($api_weather_url . "?q=" . $city . "&APPID=" . $api_weather_key);

        $responseObject = $response->object();
        $acctualTemp = $responseObject->main->temp;
        return $acctualTemp;
    }
}
