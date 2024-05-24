<?php

namespace Buy\CreateArticle\Domain\Service;

use Buy\CreateArticle\Domain\Model\RepositoryGetGama;
class ServiceGetGama
{
    public function __construct(
        private readonly RepositoryGetGama $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->getGama();
    }
}
