<?php

namespace Suppliers\ListCreditors\Domain\Model;

class ListCreditorsModel
{

    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $nif,
        private readonly string $home,
        private readonly string $postalCode,
        private readonly string $province,
        private readonly string $phoneNumber,
        private readonly string $date,
        private readonly string $country

    ){}
    public function toArray(): array
    {
        return [
            'CODPRO' => $this->getId(),
            'NOFPRO' => $this->getName(),
            'NIFPRO' => $this->getNif(),
            'DOMPRO' => $this->getHome(),
            'CPOPRO' => $this->getPostalCode(),
            'PROPRO' => $this->getProvince(),
            'TELPRO' => $this->getPhoneNumber(),
            'FALPRO' => $this->getDate(),
            'PAIPRO' => $this->getCountry()
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
    public function getNif(): string
    {
        return $this->nif;
    }
    public function getHome(): string
    {
        return $this->home;
    }
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }
    public function getProvince(): string
    {
        return $this->province;
    }
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
    public function getDate(): string
    {
        return $this->date;
    }
    public function getCountry(): string
    {
        return $this->country;
    }
}
