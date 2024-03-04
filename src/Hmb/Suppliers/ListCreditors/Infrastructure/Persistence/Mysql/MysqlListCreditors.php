<?php

namespace Suppliers\ListCreditors\Infrastructure\Persistence\Mysql;

use Illuminate\Support\Facades\DB;
use Suppliers\ListCreditors\Domain\Model\ListCreditorsModel;
use Suppliers\ListCreditors\Domain\Model\ListCreditorsRepository;
class MysqlListCreditors implements ListCreditorsRepository
{
    private string $connection='dbServer';
    private string $plSuppliers='imp.pl_proveedores';
    private string $pcSuppliers='imp.pc_proveedores';
    private string $plArticles='imp.pl_articulos';
    public function search(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->pcSuppliers .' as pc')
            ->leftJoin($this->plSuppliers .' as pl', function ($join) {
                $join->on('pc.xproveedor_id', '=', 'pl.xproveedor_id')
                    ->on('pc.xempgen_id', '=', 'pl.xempresa_id');
            })
            ->whereNull('pl.xmodalidad_id')
            ->where('pl.xfecha_alta', '>=', '2019-01-01')
            ->select('pc.xproveedor_id', 'pc.xnombre')
            ->distinct()
            ->get()
            ->map(fn($item) => $this->mapListCreditors($item)->toArray());
    }
    public function mapListCreditors($item): ListCreditorsModel
    {
        return new ListCreditorsModel(
            $item->xproveedor_id,
            $item->xnombre
        );
    }
}
