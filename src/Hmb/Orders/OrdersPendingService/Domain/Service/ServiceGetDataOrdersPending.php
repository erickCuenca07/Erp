<?php

namespace Orders\OrdersPendingService\Domain\Service;

use Orders\OrdersPendingService\Domain\Model\OrdersPendingServiceRepository;
class ServiceGetDataOrdersPending
{
    public function __construct(
        private readonly OrdersPendingServiceRepository $repository
    ){}

    public function execute($order): mixed
    {
        return $this->repository->getData($order);
    }
}
