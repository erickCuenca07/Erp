<?php

namespace Orders\OrdersPendingService\Domain\Service;

use Orders\OrdersPendingService\Domain\Model\OrdersPendingServiceRepository;
class ServiceOrdersPendingService
{
    public function __construct(
        private readonly OrdersPendingServiceRepository $repository
    ){}

    public function execute(): mixed
    {
        return $this->repository->search();
    }
}
