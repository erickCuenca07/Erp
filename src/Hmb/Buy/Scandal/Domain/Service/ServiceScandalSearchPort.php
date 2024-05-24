<?php

namespace Buy\Scandal\Domain\Service;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchPort;
class ServiceScandalSearchPort
{

    public function __construct(
        private readonly RepositoryScandalSearchPort $repository
    ){}

    public function execute(): mixed
    {
        return $this->repository->searchPort();
    }
}
