<?php

namespace Buy\Scandal\Application\Handler;

use Buy\Scandal\Domain\Service\ServiceScandalSearchScandalId;
class HandlerScandalSearchScandalId
{
    public function __construct(
        private readonly ServiceScandalSearchScandalId $service
    ){}
    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
