<?php

namespace Buy\Scandal\Infrastructure\Persistence\Mysql;

use Buy\Scandal\Domain\Model\RepositoryGetClients;
use Illuminate\Support\Facades\DB;

class MysqlGetClients implements RepositoryGetClients
{
    private string $connection = 'sqlsrv';
    private string $pcClients = 'imp.pc_clientes';
    private string $plClients = 'imp.pl_clientes';
    public function getClients(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->pcClients.' as pc')
            ->join($this->plClients.' as pl', function ($join) {
                $join->on('pc.xcliente_id', '=', 'pl.xcliente_id')
                    ->on('pc.xempgen_id', '=', 'pl.xempresa_id');
            })
            ->where('pc.xempgen_id', '=', 'SM')
            ->where('pl.xfecha_alta', '>=', '2019-01-01')
            ->select('pc.xcliente_id','pc.xnombre')
            ->get()
            ->map(fn($item) => $this->mapGetClients($item))
            ->toArray();
    }
    public function mapGetClients($item): array
    {
        return[
            'idClient' => $item->xcliente_id,
            'nameClient' => $item->xnombre
        ];
    }
}
