<?php

namespace Admin\Users\Application\Handler;

use Admin\Users\Domain\Service\UserUpdateService;
class HandlerUserUpdate
{
    public function __construct(
        private readonly UserUpdateService $service
    ){}

    public function handle($data): mixed
    {
        return $this->service->execute($data);
    }
}
