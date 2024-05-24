<?php

namespace Admin\Users\Application\Handler;

use Admin\Users\Domain\Service\UserDeleteService;
class HandlerUserDelete
{
    public function __construct(
        private readonly UserDeleteService $service
    ){}

    public function handle($id)
    {
        return $this->service->execute($id);
    }
}
