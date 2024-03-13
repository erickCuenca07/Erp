<?php

namespace Families\ListFamilies\Application\Handler;

use Families\ListFamilies\Domain\Service\ListFamiliesService;
class HandlerListFamilies
{

    public function __construct(
        private readonly ListFamiliesService $service
    ){}

    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
