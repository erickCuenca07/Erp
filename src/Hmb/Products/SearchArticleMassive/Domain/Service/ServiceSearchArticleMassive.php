<?php

namespace Products\SearchArticleMassive\Domain\Service;

use Products\SearchArticleMassive\Domain\Model\RepositorySearchArticleMassive;

class ServiceSearchArticleMassive
{
    public function __construct(
        private readonly RepositorySearchArticleMassive $repository
    ){}
    public function execute($search): mixed
    {
        return $this->repository->searchArticleMassive($search);
    }
}
