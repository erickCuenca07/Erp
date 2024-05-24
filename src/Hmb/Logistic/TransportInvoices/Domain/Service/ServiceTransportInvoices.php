<?php

namespace Logistic\TransportInvoices\Domain\Service;

use Logistic\TransportInvoices\Domain\Model\RepositorySearchTransportInvoices;
class ServiceTransportInvoices
{
    public function __construct(
        private readonly RepositorySearchTransportInvoices $repository
    ){}
    public function execute($data): mixed
    {
        return $this->repository->search($data);
    }
}
