<?php

namespace Buy\Scandal\Infrastructure\Persistence\Mysql;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchPort;
use Illuminate\Support\Facades\DB;

class MysqlScandalSearchPort implements RepositoryScandalSearchPort
{
    private string $connection = 'sqlsrv';
    private string $tablePort = 'imp.sm_puertos';
    public function searchPort(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->tablePort.' as p')
            ->select('p.xpuerto_id as id')
            ->get()
            ->toArray();
    }
}
