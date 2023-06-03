<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherStoreRequest;
use App\Repositories\Interfaces\WeatherRepositoryInterface;
use Exception;
use App\Http\Resources\WeatherResource;

class WeatherController extends Controller
{

    private $repository;

    public function __construct(WeatherRepositoryInterface $weatherRepository)
    {
        $this->repository = $weatherRepository;
    }

    /**
     * Get list with all cities
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WeatherResource::collection($this->repository->index());
    }

    /**
     * Store weather for specyfic city
     *
     * @param \App\Http\Requests\WeatherStoreRequest $request 
     * @return \Illuminate\Http\Response
     */
    public function store(WeatherStoreRequest $request)
    {
        try {
            $this->repository->store($request->all());
        } catch (Exception $e) {
            return response("We couldnt save your cities.", 400);
        }
        return response("Cities are updated.", 201);
    }

    /**
     * Get weather for specyfic city from api
     *
     * @param string $city
     * @return float
     */
    public function getWeatherFromApi($city)
    {
        return $this->repository->store($city);
    }
}
