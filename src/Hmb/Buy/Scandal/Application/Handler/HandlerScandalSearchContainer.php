<?php

namespace Buy\Scandal\Application\Handler;

use Buy\Scandal\Domain\Service\ServiceScandalSearchContainer;
class HandlerScandalSearchContainer
{
    public function __construct(
        private  readonly ServiceScandalSearchContainer $serviceScandalSearchContainer
    ){}
    public function handle(): mixed
    {
        return $this->serviceScandalSearchContainer->execute();
    }
}
