<?php
namespace Admin\Users\Domain\Service;

use Admin\Users\Domain\Model\UserInsertRepository;

class UserInsertService
{
    public function __construct(
        private readonly UserInsertRepository $repository
    )
    {}
    public function execute($data): mixed
    {
        return $this->repository->search($data);
    }
}
