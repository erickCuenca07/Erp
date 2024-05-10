<?php
namespace Suppliers\ListSuppliers\Domain\Model;

use Carbon\Carbon;

class ListSuppliersModel
{
    public function __construct(
        private readonly int $idProveedor,
        private readonly string $nombre,
        private readonly string $nif,
        private readonly string $domicilio,
        private readonly string $cp,
        private readonly string $provincia,
        private readonly string $telefono,
        private readonly string $fechaAlta,
        private readonly string $pais

    ){}
    public function toArray(): array
    {
        return [
            'idProveedor' => $this->getId(),
            'nombre' => $this->getName(),
            'nif' => $this->getNif(),
            'domicilio' => $this->getHome(),
            'cp' => $this->getPostalCode(),
            'provincia' => $this->getProvince(),
            'telefono' => $this->getPhoneNumber(),
            'fechaAlta' => $this->getDate(),
            'pais' => $this->getCountry()
        ];
    }
    public function getId(): int
    {
        return $this->idProveedor;
    }
    public function getName(): string
    {
        return $this->nombre;
    }
    public function getNif(): string
    {
        return $this->nif;
    }
    public function getHome(): string
    {
        return $this->domicilio;
    }
    public function getPostalCode(): string
    {
        return $this->cp;
    }
    public function getProvince(): string
    {
        return $this->provincia;
    }
    public function getPhoneNumber(): string
    {
        return $this->telefono;
    }
    public function getDate(): string
    {
        return $this->fechaAlta;
    }
    public function getCountry(): string
    {
        return $this->pais;
    }
}
