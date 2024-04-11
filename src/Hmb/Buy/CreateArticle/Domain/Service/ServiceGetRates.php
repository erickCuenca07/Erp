<?php

namespace Buy\CreateArticle\Domain\Service;

use Buy\CreateArticle\Domain\Model\RepositoryGetRates;
class ServiceGetRates
{
    public function __construct(
        private readonly RepositoryGetRates $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->getRates();
    }
}
