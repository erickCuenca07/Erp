<?php
namespace Shared\Domain\Service;
use Illuminate\Support\Carbon;
class CarbonEurope
{
    public function now(): string
    {
        return Carbon::now()->locale('es')->timezone('Europe/Madrid')->format('Y-m-d H:i:s');
    }
}
