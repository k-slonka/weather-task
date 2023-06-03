<?php

namespace App\Services;

use Mwakalingajohn\LaravelEasyRepository\Service;

class BaseService extends Service{

    /**
    * The repository interface to use in this service. Will allow to use within
    * methods $this->repository. It will be resolved from the container
    * @property string $repositoryInterface;
    */
    protected string $repositoryInterface = "App\Repositories\Interfaces\BaseRepositoryInterface";

    // Define your custom methods :)
}
