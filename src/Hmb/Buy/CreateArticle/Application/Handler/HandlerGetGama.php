<?php

namespace Buy\CreateArticle\Application\Handler;

use Buy\CreateArticle\Domain\Service\ServiceGetGama;
class HandlerGetGama
{
    public function __construct(
        private readonly ServiceGetGama $service
    ){}
    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
