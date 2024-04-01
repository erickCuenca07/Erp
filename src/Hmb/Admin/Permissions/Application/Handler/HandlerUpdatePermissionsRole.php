<?php

namespace Admin\Permissions\Application\Handler;
use Admin\Permissions\Domain\Service\ServiceUpdatePermissionsRole;
class HandlerUpdatePermissionsRole
{
    public function __construct(
        private readonly ServiceUpdatePermissionsRole $service
    ){}
    public function handle($data): mixed
    {
        return $this->service->execute($data);
    }
}
