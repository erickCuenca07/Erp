<?php

namespace Buy\CreateArticle\Application\Handler;

use Buy\CreateArticle\Domain\Service\ServiceSearchArticle;
class HandlerSearchArticle
{
    public function __construct(
        private readonly ServiceSearchArticle $service
    ){}
    public function handle($data): mixed
    {
        return $this->service->execute($data);
    }
}
