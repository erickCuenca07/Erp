<?php

namespace Buy\CreateArticle\Application\Handler;

use Buy\CreateArticle\Domain\Service\ServiceGetRates;
class HandlerGetRates
{
    public function __construct(
        private readonly ServiceGetRates $service
    ){}
    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
