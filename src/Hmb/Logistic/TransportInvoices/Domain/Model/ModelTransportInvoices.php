<?php

namespace Logistic\TransportInvoices\Domain\Model;

class ModelTransportInvoices
{
    public function __construct(
        public readonly int $medioId,
        public readonly string $nameMedio,
        public readonly string $dateAlbaran,
        public readonly int $clientId,
        public readonly string $clientName,
        public readonly string $provincesName,
        public readonly string $populationName,
        public readonly string $reference,
        public readonly int $bultos,
        public readonly int $numAlb,
        public readonly float $netWeight,
        public readonly string $paymed,
        public readonly float $import,
        public readonly int $articleId,
        public readonly float $volume,
        public readonly int $quantity,
        public readonly string $sizeBag,
        public readonly string $unitBag,
        public readonly int $repreId,
        public readonly string $repreName,
        public readonly float $netTotal
    ){}
    public function toArray(): array
    {
        return [
            'medioId' => $this->getMedioId(),
            'nameMedio' => $this->getNameMedio(),
            'dateAlbaran' => $this->getDateAlbaran(),
            'clienteId' => $this->getClientId(),
            'clientName' => $this->getClientName(),
            'provincesName' => $this->getProvincesName(),
            'populationName' => $this->getPopulationName(),
            'reference' => $this->getReference(),
            'bultos' => $this->getBultos(),
            'numAlb' => $this->getNumAlb(),
            'netWeight' => $this->getNetWeight(),
            'paymed' => $this->getPaymed(),
            'import' => $this->getImport(),
            'articleId' => $this->getArticleId(),
            'volume' => $this->getVolume(),
            'quantity' => $this->getQuantity(),
            'sizeBag' => $this->getSizeBag(),
            'unitBag' => $this->getUnitBag(),
            'repreId' => $this->getRepreId(),
            'repreName' => $this->getRepreName(),
            'netTotal' => $this->getNetTotal(),
        ];
    }
    public function getNetTotal(): float
    {
        return $this->netTotal;
    }
    public function getRepreId (): int
    {
        return $this->repreId;
    }
    public function getRepreName (): string
    {
        return $this->repreName;
    }
    public function getMedioId(): int
    {
        return $this->medioId;
    }

    public function getNameMedio(): string
    {
        return $this->nameMedio;
    }
    public function getDateAlbaran(): string
    {
        return $this->dateAlbaran;
    }
    public function getClientId(): int
    {
        return $this->clientId;
    }
    public function getClientName(): string
    {
        return $this->clientName;
    }
    public function getProvincesName(): string
    {
        return $this->provincesName;
    }
    public function getPopulationName(): string
    {
        return $this->populationName;
    }
    public function getReference(): string
    {
        return $this->reference;
    }
    public function getBultos(): int
    {
        return $this->bultos;
    }
    public function getNumAlb(): int
    {
        return $this->numAlb;
    }
    public function getNetWeight(): float
    {
        return $this->netWeight;
    }
    public function getPaymed(): string
    {
        return $this->paymed;
    }
    public function getImport(): float
    {
        return $this->import;
    }
    public function getArticleId(): int
    {
        return $this->articleId;
    }
    public function getVolume(): float
    {
        return $this->volume;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function getSizeBag(): string
    {
        return $this->sizeBag;
    }
    public function getUnitBag(): string
    {
        return $this->unitBag;
    }
}
