<?php

namespace Suppliers\ListCreditors\Domain\Model;

class ListCreditorsModel
{

    public function __construct(
        private readonly string $id,
        private readonly string $name
    ){}
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];
    }
    public function getId(): string
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
}
