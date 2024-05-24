<?php

namespace Buy\CreateArticle\Application\Handler;

use Buy\CreateArticle\Domain\Service\ServiceGetClients;

class HandlerGetClients
{

    public function __construct(
        private readonly ServiceGetClients $service
    ){}

    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
