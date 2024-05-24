<?php

namespace Products\SearchArticle\Domain\Service;

use Products\SearchArticle\Domain\Model\RepositorySearchArticleModel;

class ServiceSearchArticleModel
{
    public function __construct(
        private readonly RepositorySearchArticleModel $repository
    ){}

    public function execute($search): mixed
    {
        return $this->repository->search($search);
    }
}
