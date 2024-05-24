<?php

namespace Families\ListFamilies\Domain\Service;

use Families\ListFamilies\Domain\Model\ListFamiliesRepository;
class ListFamiliesService
{

    public function __construct(
        private readonly ListFamiliesRepository $repository
    ) {}

    public function execute(): mixed
    {
        return $this->repository->search();
    }
}
