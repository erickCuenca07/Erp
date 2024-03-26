<?php

namespace Orders\OrdersPendingService\Domain\Model;

class OrdersPendingServiceModel
{

    public function __construct(
        public readonly string $numDocId,
        public readonly string $clientId,
        public readonly string $nameClient,
        public readonly string $tipDocId,
        public readonly string $nameTipDoc,
        public readonly string $dateOrder,
        public readonly string $dateDelivery,
        public readonly string $coin,
        public readonly string $WayPay,
        public readonly string $NameWayPay
    ){}
    public function toArray(): array
    {
        return [
            'numDocId' => $this->getNumDocId(),
            'clientId' => $this->getClientId(),
            'nameClient' => $this->getNameClient(),
            'tipDocId' => $this->getTipDocId(),
            'nameTipDoc' => $this->getNameTipDoc(),
            'dateOrder' => $this->getDateOrder(),
            'dateDelivery' => $this->getDateDelivery(),
            'coin' => $this->getCoin(),
            'WayPay' => $this->getWayPay(),
            'NameWayPay' => $this->getNameWayPay()
        ];
    }
    public function getNumDocId(): string
    {
        return $this->numDocId;
    }
    public function getClientId(): string
    {
        return $this->clientId;
    }
    public function getNameClient(): string
    {
        return $this->nameClient;
    }
    public function getTipDocId(): string
    {
        return $this->tipDocId;
    }
    public function getNameTipDoc(): string
    {
        return $this->nameTipDoc;
    }
    public function getDateOrder(): string
    {
        return $this->dateOrder;
    }
    public function getDateDelivery(): string
    {
        return $this->dateDelivery;
    }
    public function getCoin(): string
    {
        return $this->coin;
    }
    public function getWayPay(): string
    {
        return $this->WayPay;
    }
    public function getNameWayPay(): string
    {
        return $this->NameWayPay;
    }
}
