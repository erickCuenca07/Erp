<?php

namespace Buy\Scandal\Domain\Service;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchContainer;
class ServiceScandalSearchContainer
{
    public function __construct(
        private readonly RepositoryScandalSearchContainer $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->searchContainer();
    }
}
