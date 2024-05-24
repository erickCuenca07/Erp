<?php

namespace Buy\Scandal\Domain\Service;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchArticle;
class ServiceScandalSearchArticle
{
    public function __construct(
        private readonly RepositoryScandalSearchArticle $repository
    ){}
    public function execute($data): mixed
    {
        return $this->repository->searchArticle($data);
    }
}
