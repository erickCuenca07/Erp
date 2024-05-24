<?php

namespace Suppliers\ListCreditors\Domain\Service;

use Suppliers\ListCreditors\Domain\Model\ListCreditorsRepository;
class ListCreditorsService
{

    public function __construct(
        private readonly ListCreditorsRepository $repository
    ) {}

    public function execute(): mixed
    {
        return $this->repository->search();
    }
}
