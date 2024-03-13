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
        $token = '';
        try {
            $response = $this->api->login();
            if ($response['respuesta'] === 'OK') {
                $token = $response['resultado'];
            }
            return $this->api->insertFamilies($token);
           //return $this->api->ExecuteQuery($token);
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

}
