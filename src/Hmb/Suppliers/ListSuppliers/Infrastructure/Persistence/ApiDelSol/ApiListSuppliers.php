<?php

namespace Suppliers\ListSuppliers\Infrastructure\Persistence\ApiDelSol;

use Api\DelSol\Infrastructure\Persistence\DelSol\ApiDelSolModel;
use Exception;
use RuntimeException;
use Suppliers\ListSuppliers\Domain\Model\ListSuppliersRepository;

class ApiListSuppliers implements ListSuppliersRepository
{

    public function search(): mixed
    {
        return $this->LoginAndGetSuppliersApi();
    }
    public function LoginAndGetSuppliersApi(): mixed
    {
        $ApiDelSol = new ApiDelSolModel();
        $response = $ApiDelSol->login();
        $token = '';
        try {
            if ($response['respuesta'] === 'OK') {
                $token = $response['resultado'];
            }
            return $ApiDelSol->getAllSuppliers($token);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}
