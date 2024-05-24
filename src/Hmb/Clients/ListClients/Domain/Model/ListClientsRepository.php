<?php
    namespace Clients\ListClients\Domain\Model;
interface ListClientsRepository
{
    public function search(): mixed;
}