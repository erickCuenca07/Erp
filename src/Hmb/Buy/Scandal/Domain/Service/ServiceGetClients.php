<?php

namespace Buy\Scandal\Domain\Service;

use Buy\Scandal\Domain\Model\RepositoryGetClients;

class ServiceGetClients
{
    public function __construct(
        private readonly RepositoryGetClients $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->getClients();
    }
}
