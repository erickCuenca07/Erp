<?php

namespace Buy\CreateArticle\Domain\Service;

use Buy\CreateArticle\Domain\Model\RepositoryGetClients;

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
