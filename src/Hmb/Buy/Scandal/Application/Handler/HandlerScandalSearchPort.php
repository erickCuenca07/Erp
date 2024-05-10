<?php

namespace Buy\Scandal\Application\Handler;

use Buy\Scandal\Domain\Service\ServiceScandalSearchPort;
class HandlerScandalSearchPort
{

    public function __construct(
        private readonly ServiceScandalSearchPort $serviceScandalSearchPort
    ){}
    public function handle(): array
    {
        return $this->serviceScandalSearchPort->execute();
    }
}
