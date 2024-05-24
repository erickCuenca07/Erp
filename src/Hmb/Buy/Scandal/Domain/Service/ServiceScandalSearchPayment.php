<?php

namespace Buy\Scandal\Domain\Service;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchPayment;
class ServiceScandalSearchPayment
{

    public function __construct(
        private readonly RepositoryScandalSearchPayment $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->searchPayment();
    }
}
