<?php
    namespace Clients\ListClients\Domain\Model;
class ListClientsModel
{
    public function __construct(
        private readonly string $idClient,
        private readonly string $nameClient,
        private readonly int $numOrder,
    )
    {}
    public function toArray(): array
    {
        return [
            'idClient' => $this->getIdClient(),
            'nameClient' => $this->getNameClient(),
            'numOrder' => $this->getNumOrder(),
        ];
    }
    public function getIdClient(): string
    {
        return $this->idClient;
    }
    public function getNameClient(): string
    {
        return $this->nameClient;
    }
    public function getNumOrder(): int
    {
        return $this->numOrder;
    }
}
