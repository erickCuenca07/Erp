<?php

namespace Buy\Scandal\Domain\Service;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchSupplier;
class ServiceScandalSearchSupplier
{
    public function __construct(
        private readonly RepositoryScandalSearchSupplier $repository
    ){}
    public function execute($data): mixed
    {
        return $this->repository->searchSupplier($data);
    }
}
