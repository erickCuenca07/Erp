<?php
namespace Families\ListFamilies\Domain\Model;
class ListFamiliesModel
{

    public function __construct(
        public readonly int $CODFAM,
        public readonly string $DESFAM
    ){}

    public function toArray(): array
    {
        return [
            'CODFAM' => $this->getCodFam(),
            'DESFAM' => $this->getDesFam(),
        ];
    }
    public function getCodFam(): int
    {
        return $this->CODFAM;
    }
    public function getDesFam(): string
    {
        return $this->DESFAM;
    }
}
