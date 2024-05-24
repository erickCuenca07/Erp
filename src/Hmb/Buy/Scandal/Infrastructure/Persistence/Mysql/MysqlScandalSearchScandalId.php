<?php

namespace Buy\Scandal\Infrastructure\Persistence\Mysql;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchScandalId;
use Illuminate\Support\Facades\DB;

class MysqlScandalSearchScandalId implements RepositoryScandalSearchScandalId
{
    private string $connection = 'sqlsrv';
    private string $scandal = 'imp.rpl_mc_escan_cab';
    public function searchScandalId(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->scandal)
            ->select(DB::raw('max(xescandallo_id) as escandallo'))
            ->first();
    }
}
