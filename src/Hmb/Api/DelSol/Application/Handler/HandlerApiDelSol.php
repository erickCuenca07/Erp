<?php
namespace Api\DelSol\Application\Handler;
use Api\DelSol\Domain\Service\ApiDelSolService;
class HandlerApiDelSol
{
    public function __construct(
        private readonly ApiDelSolService $service
    ){}
    public function handler():mixed
    {
        return $this->service->execute();
    }
}
