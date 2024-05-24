<?php

namespace Admin\Users\Domain\Service;

use Admin\Users\Domain\Model\UserInsertRepository;
class UserDeleteService
{
    public function __construct(
        private readonly UserInsertRepository $repository
    ){}
    public function execute($id)
    {
        return $this->repository->delete($id);
    }
}
