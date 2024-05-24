<?php

namespace Logistic\TransportInvoices\Application\Handler;

use Logistic\TransportInvoices\Domain\Service\ServiceTransportInvoices;
class HandlerSearchTransportInvoices
{
    public function __construct(
        private readonly ServiceTransportInvoices $service
    ){}

    public function handle($data): mixed
    {
        return $this->service->execute($data);
    }
}
