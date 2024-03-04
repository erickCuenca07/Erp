<?php
namespace Suppliers\ListSuppliers\Infrastructure\Persistence\Mysql;

use Illuminate\Support\Facades\DB;
use Suppliers\ListSuppliers\Domain\Model\ListSuppliersModel;
use Suppliers\ListSuppliers\Domain\Model\ListSuppliersRepository;
class MysqlListSuppliers implements ListSuppliersRepository
{
    private string $connection = 'dbServer';
    private string $plSuppliers = 'imp.pl_proveedores';
    private string $pcSuppliers = 'imp.pc_proveedores';
    private string $plArticles = 'imp.pl_articulos';
    public function search(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->pcSuppliers.' as pc')
            ->leftJoin($this->plSuppliers.' as pl', function ($join) {
                $join->on('pl.xproveedor_id', '=', 'pc.xproveedor_id')
                    ->on('pl.xempresa_id', '=', 'pc.xempgen_id');
            })
            ->leftJoin($this->plArticles.' as art', 'pl.xproveedor_id', '=', 'art.xproveedor_id')
            ->where('art.xfecha_alta', '>=', '2019-01-01')
            ->select('pc.xproveedor_id', 'pc.xnombre')
            ->distinct()
            ->get()
            ->map(fn($item) => $this->mapSearch($item)->toArray());
    }
    public function mapSearch($item): ListSuppliersModel
    {
        return new ListSuppliersModel(
            $item->xproveedor_id,
            $item->xnombre
        );
    }
}
