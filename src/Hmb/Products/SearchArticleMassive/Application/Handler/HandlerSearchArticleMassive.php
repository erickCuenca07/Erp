<?php

namespace Products\SearchArticleMassive\Application\Handler;

use Products\SearchArticleMassive\Domain\Service\ServiceSearchArticleMassive;

class HandlerSearchArticleMassive
{

    public function __construct(
        private readonly ServiceSearchArticleMassive $service
    ){}

    public function handle($data)
    {
        return $this->service->execute($data);
    }
}
