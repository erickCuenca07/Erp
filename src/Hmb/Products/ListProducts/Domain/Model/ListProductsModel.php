<?php

namespace Products\ListProducts\Domain\Model;

class ListProductsModel
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $date,
        private readonly string $nameSupplier
    ){}

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'date' => $this->getDate(),
            'nameSupplier' => $this->getNameSupplier(),
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDate(): string
    {
        return $this->date;
    }
    public function getNameSupplier(): string
    {
        return $this->nameSupplier;
    }
}
