<?php

namespace Buy\CreateArticle\Domain\Service;

use Buy\CreateArticle\Domain\Model\RepositorySearchArticle;
class ServiceSearchArticle
{
    public function __construct(
        private readonly RepositorySearchArticle $repository
    ){}

    public function execute(array $data): mixed
    {
        return $this->repository->searchArticle($data);
    }
}
