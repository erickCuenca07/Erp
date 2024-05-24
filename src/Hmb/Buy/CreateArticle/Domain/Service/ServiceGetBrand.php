<?php

namespace Buy\CreateArticle\Domain\Service;

use Buy\CreateArticle\Domain\Model\RepositoryGetBrand;
class ServiceGetBrand
{
    public function __construct(
        private readonly RepositoryGetBrand $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->getBrand();
    }
}
