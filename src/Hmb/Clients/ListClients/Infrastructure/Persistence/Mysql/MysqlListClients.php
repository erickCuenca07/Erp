<?php

namespace Clients\ListClients\Infrastructure\Persistence\Mysql;

use Clients\ListClients\Domain\Model\ListClientsRepository;
use Illuminate\Support\Facades\DB;

class MysqlListClients implements ListClientsRepository
{
    private string $connection = 'dbServer';
    private string $pc_clients = 'imp.pc_clientes';
    private string $pl_clients = 'imp.pl_clientes';
    private string $pl_hPedCliCab = 'imp.pl_hpedcli_cab';



    public function search(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->pc_clients.' as pc')
            ->leftJoin($this->pl_clients.' as pl', function ($join) {
                $join->on('pc.xcliente_id', '=', 'pl.xcliente_id')
                    ->on('pc.xempgen_id', '=', 'pl.xempresa_id');
            })
            ->leftJoin($this->pl_hPedCliCab.' as ph', 'pc.xcliente_id', '=', 'ph.xcliente_id')
            ->where('ph.xfecha_pedido','>=','2019-01-01')
            ->where('pc.xempgen_id', '=', 'SM')
            ->select('pc.xcliente_id',DB::raw('COUNT(ph.xnumdoc_id) as numOrder'),'pc.xnombre')
            ->groupBy('pc.xcliente_id','pc.xnombre')
            ->orderBy('numOrder', 'desc')
            ->get()
            ->map(fn($item) => $this->mapSearch($item))
            ->toArray();
    }
    private function mapSearch($item):array
    {
        return[
          'idClient' => $item->xcliente_id,
          'nameClient' => $item->xnombre,
          'numOrder' => $item->numOrder
        ];
    }
}
