<?php

namespace Buy\CreateArticle\Application\Handler;

use Buy\CreateArticle\Domain\Service\ServiceGetBrand;
class HandlerGetBrand
{
    public function __construct(
        private readonly ServiceGetBrand $service
    ){}
    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
