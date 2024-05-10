<?php

namespace Buy\Scandal\Application\Handler;

use Buy\Scandal\Domain\Service\ServiceScandalSearchArticle;
class HandlerScandalSearchArticle
{
    public function __construct(
        private readonly ServiceScandalSearchArticle $service
    ){}
    public function handle($data): mixed
    {
        return $this->service->execute($data);
    }
}
