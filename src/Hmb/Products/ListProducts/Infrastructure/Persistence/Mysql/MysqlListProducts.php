<?php

namespace Products\ListProducts\Infrastructure\Persistence\Mysql;

use Illuminate\Support\Facades\DB;
use Products\ListProducts\Domain\Model\ListProductsModel;
use Products\ListProducts\Domain\Model\ListProductsRepository;
class MysqlListProducts implements ListProductsRepository
{
    private string $connection = 'dbServer';
    private string $plProducts = 'imp.pl_articulos';
    private string $plSuppliers = 'imp.pl_proveedores';
    private string $pcSuppliers = 'imp.pc_proveedores';
    public function search(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->plProducts . ' as art')
            ->leftJoin($this->plSuppliers . ' as pl', 'art.xproveedor_id', '=', 'pl.xproveedor_id')
            ->leftJoin($this->pcSuppliers . ' as pc', function ($join) {
                $join->on('pl.xproveedor_id', '=', 'pc.xproveedor_id')
                    ->on('pl.xempresa_id', '=', 'pc.xempgen_id');
            })
            ->where('art.xfecha_alta', '>=', '2019-01-01')
            ->select('art.xarticulo_id', 'art.xdescripcion', 'art.xfecha_alta', 'pc.xnombre')
            ->orderBy('art.xfecha_alta', 'asc')
            ->get()
            ->map(fn($item) => $this->mapListProducts($item)->toArray())
            ->toArray();
    }
    public function mapListProducts($item): ListProductsModel
    {
        return new ListProductsModel(
            $item->xarticulo_id,
            $item->xdescripcion,
            $item->xfecha_alta,
            $item->xnombre
        );
    }
}
