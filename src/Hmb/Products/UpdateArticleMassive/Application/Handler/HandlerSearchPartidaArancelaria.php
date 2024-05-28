<?php

namespace Products\UpdateArticleMassive\Application\Handler;

use Products\UpdateArticleMassive\Domain\Service\ServiceSearchPartidaArancelaria;
class HandlerSearchPartidaArancelaria
{
    public function __construct(
        private readonly ServiceSearchPartidaArancelaria $service
    ){}
    public function handle()
    {
        return $this->service->execute();
    }
}
