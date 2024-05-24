<?php

namespace Admin\Permissions\Domain\Service;

use Admin\Permissions\Domain\Model\UpdatePermissionsRole;
class ServiceUpdatePermissionsRole
{
    public function __construct(
        private readonly UpdatePermissionsRole $repository
    ){}

    public function execute($data): mixed
    {
        return $this->repository->search($data);
    }
}
