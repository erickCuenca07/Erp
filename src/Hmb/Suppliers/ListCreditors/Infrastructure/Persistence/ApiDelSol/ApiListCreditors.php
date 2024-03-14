<?php

namespace Suppliers\ListCreditors\Infrastructure\Persistence\ApiDelSol;

use Suppliers\ListCreditors\Domain\Model\ListCreditorsRepository;
use Api\DelSol\Infrastructure\Persistence\DelSol\ApiDelSolModel;
use Exception;
use RuntimeException;
class ApiListCreditors implements ListCreditorsRepository
{

    public function search(): mixed
    {
        return $this->LoginAndGetCreditorsApi();
    }
    public function LoginAndGetCreditorsApi(): mixed
    {
        $apiDelSol = new ApiDelSolModel();
        $response = $apiDelSol->login();
        $token = '';
        try {
            if ($response['respuesta'] === 'OK') {
                $token = $response['resultado'];
            }
            return $apiDelSol->getAllCreditors($token);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}
