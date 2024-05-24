<?php

namespace Buy\Scandal\Application\Handler;

use Buy\Scandal\Domain\Service\ServiceScandalSearchSupplier;
class HandlerScandalSearchSupplier
{
    public function __construct(
        private readonly ServiceScandalSearchSupplier $service
    ){}
    public function handle($data): mixed
    {
        return $this->service->execute($data);
    }
}
