<?php

namespace Buy\Scandal\Domain\Service;

use Buy\Scandal\Domain\Model\RepositoryScandal;

class ServiceScandalCreate
{
    public function __construct(
        private readonly RepositoryScandal $repository
    ){}

    public function execute(): mixed
    {
        return $this->repository->search();
    }
}
