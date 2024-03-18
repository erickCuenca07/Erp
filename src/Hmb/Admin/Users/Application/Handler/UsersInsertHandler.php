<?php
namespace Admin\Users\Application\Handler;

use Admin\Users\Domain\Service\UserInsertService;

class UsersInsertHandler
{
    public function __construct(
        private readonly UserInsertService $service
    ){}

    public function handle($data):mixed
    {
        return $this->service->execute($data);
    }
}
