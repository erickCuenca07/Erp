<?php

namespace Products\UpdateArticleMassive\Domain\Service;

use Products\UpdateArticleMassive\Domain\Model\RepositorySearchPartidaArancelaria;
class ServiceSearchPartidaArancelaria
{
    public function __construct(
        private readonly RepositorySearchPartidaArancelaria $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->find();
    }
}
