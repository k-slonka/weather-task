<?php

namespace App\Repositories\Interfaces;

interface WeatherRepositoryInterface extends EloquentRepositoryInterface
{

    /**
     * @param array $data
     * @return bool
     */
    public function store($data): bool;

    /**
     * @param string $city
     * @return float
     */
    public function getWeatherFromApi($city): float;
}
