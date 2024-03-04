<?php

namespace Api\DelSol\Domain\Service;
use Api\DelSol\Domain\Model\ApiDelSol;

class ApiDelSolService
{
    public function __construct(
        private readonly  ApiDelSol $repository
    ){}

    public function execute(): mixed
    {
        return $this->repository->executeApiDelSol();
    }
}
