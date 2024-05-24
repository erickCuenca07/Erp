<?php

namespace Buy\Scandal\Domain\Service;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchScandalId;
class ServiceScandalSearchScandalId
{
    public function __construct(
        private readonly RepositoryScandalSearchScandalId $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->searchScandalId();
    }
}
