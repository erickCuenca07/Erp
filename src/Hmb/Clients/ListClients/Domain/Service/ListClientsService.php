<?php 
namespace Clients\ListClients\Domain\Service;

use Clients\ListClients\Domain\Model\ListClientsRepository;

class ListClientsService
{
    public function __construct(
        private readonly ListClientsRepository $repository
    ){}

    public function execute()
    {
        return $this->repository->search();
    }
}