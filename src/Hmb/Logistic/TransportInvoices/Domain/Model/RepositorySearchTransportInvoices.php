<?php

namespace Logistic\TransportInvoices\Domain\Model;

interface RepositorySearchTransportInvoices
{
    public function search($data): mixed;
}
