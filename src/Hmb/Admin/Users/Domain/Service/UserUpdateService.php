<?php

namespace Admin\Users\Domain\Service;

use Admin\Users\Domain\Model\UserInsertRepository;
class UserUpdateService
{
    public function __construct(
        private readonly UserInsertRepository $repository
    ){}
    public function execute( $data): mixed
    {
        return $this->repository->update($data);
    }
}
