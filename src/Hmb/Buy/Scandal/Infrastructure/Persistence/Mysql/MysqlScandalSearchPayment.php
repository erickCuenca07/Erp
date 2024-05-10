<?php

namespace Buy\Scandal\Infrastructure\Persistence\Mysql;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchPayment;
use Illuminate\Support\Facades\DB;
class MysqlScandalSearchPayment implements RepositoryScandalSearchPayment
{
    private string $connection = 'mysql';
    private string $payment = 'metodospagoescandallo';
    public function searchPayment(): array
    {
        return DB::connection($this->connection)
            ->table($this->payment.' as p')
            ->select('p.id')
            ->get()
            ->toArray();
    }
}
