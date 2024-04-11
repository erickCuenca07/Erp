<?php
namespace Families\ListFamilies\Domain\Model;
class ListFamiliesModel
{

    public function __construct(
        public readonly int $idFamily,
        public readonly string $nameFamily
    ){}

    public function toArray(): array
    {
        return [
            'idFamily' => $this->getIdFamily(),
            'nameFamily' => $this->getNameFamily(),
        ];
    }
    public function getIdFamily(): int
    {
        return $this->idFamily;
    }
    public function getNameFamily(): string
    {
        return $this->nameFamily;
    }
}
