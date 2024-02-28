<?php
namespace Clients\ListClients\Application\Handler;

use Clients\ListClients\Domain\Service\ListClientsService;

class HandlerListClients
{
    public function __construct(
        private readonly ListClientsService $service
    ){}
    public function handle()
    {
        return $this->service->execute();
    }
}