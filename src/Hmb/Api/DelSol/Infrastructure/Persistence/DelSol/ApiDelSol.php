<?php

namespace Api\DelSol\Infrastructure\Persistence\DelSol;

use Exception;
use RuntimeException;
use Api\DelSol\Domain\Model\ApiDelSol as RepositoryApiDelSol;
use Api\DelSol\Infrastructure\Persistence\DelSol\ApiDelSolModel;
class ApiDelSol implements RepositoryApiDelSol
{
    private ApiDelSolModel $api;

    public function __construct()
    {
        $this->api = new ApiDelSolModel();
    }

    public function executeApiDelSol(): mixed
    {
        try {
            return $this->api->login();
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

}
