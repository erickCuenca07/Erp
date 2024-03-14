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
    private string $country = 'imp.pc_paises';
    private string $provinces = 'imp.pc_provincias';
    public function search(): array
    {
        return DB::connection($this->connection)
            ->table($this->pcSuppliers.' as pc')
            ->leftJoin($this->plSuppliers.' as pl', function ($join) {
                $join->on('pl.xproveedor_id', '=', 'pc.xproveedor_id')
                    ->on('pl.xempresa_id', '=', 'pc.xempgen_id');
            })
            ->leftJoin($this->plArticles.' as art', 'pl.xproveedor_id', '=', 'art.xproveedor_id')
            ->leftJoin($this->country.' as pa', 'pc.xpais_id', '=', 'pa.xpais_id')
            ->leftJoin($this->provinces.' as pro', function ($join) {
                $join->on('pc.xprovincia_id', '=', 'pro.xprovincia_id')
                    ->on('pc.xpais_id', '=', 'pro.xpais_id');
            })
            ->where('art.xfecha_alta', '>=', '2019-01-01')
            ->select('pc.xproveedor_id', 'pc.xnombre','pc.xnif','pc.xdomicilio','pc.xcod_postal','pro.xnombre as province','pl.xtelefono','pl.xfecha_alta','pa.xnombre as country')
            ->distinct()
            ->get()
            ->map(fn($item) => $this->mapSearch($item)->toArray())
            ->toArray();
    }
    public function mapSearch($item): ListSuppliersModel
    {
        return new ListSuppliersModel(
            $item->xproveedor_id,
            $item->xnombre,
            $item->xnif,
            $item->xdomicilio,
            $item->xcod_postal ?? '',
            $item->province ?? '',
            $item->xtelefono ?? '',
            $item->xfecha_alta ?? '',
            $item->country
        );
    }
    public function SearchSupplierForId($id)
    {
        return DB::connection($this->connection)
            ->table($this->pcSuppliers.' as pc')
            ->leftJoin($this->plSuppliers.' as pl', function ($join) {
                $join->on('pl.xproveedor_id', '=', 'pc.xproveedor_id')
                    ->on('pl.xempresa_id', '=', 'pc.xempgen_id');
            })
            ->leftJoin($this->country.' as pa', 'pc.xpais_id', '=', 'pa.xpais_id')
            ->leftJoin($this->provinces.' as pro', function ($join) {
                $join->on('pc.xprovincia_id', '=', 'pro.xprovincia_id')
                    ->on('pc.xpais_id', '=', 'pro.xpais_id');
            })
            ->leftJoin($this->plArticles.' as art', 'pl.xproveedor_id', '=', 'art.xproveedor_id')
            ->where('pc.xproveedor_id', '=', $id)
            ->select('pc.xproveedor_id', 'pc.xnombre','pc.xnif','pc.xdomicilio','pc.xcod_postal','pro.xnombre as province','pl.xtelefono','pl.xfecha_alta','pa.xnombre as country')
            ->distinct()
            ->get()
            ->map(fn($item) => $this->mapSearch($item)->toArray())
            ->toArray();
    }
}
