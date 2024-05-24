<?php

namespace Products\SearchArticleMassive\Infrastructure\Persistence\Mysql;

use Illuminate\Support\Facades\DB;
use Products\SearchArticleMassive\Domain\Model\RepositorySearchArticleMassive;

class MysqlSearchArticleMassive implements RepositorySearchArticleMassive
{
    private string $connection = 'sqlsrv';
    private string $plProducts = 'imp.pl_articulos';
    private string $plProductsOpc = 'imp.pl_articulos_opc';
    private string $pcSuppliers = 'imp.pc_proveedores';
    private string $plFamilies = 'imp.pl_familias';
    private string $colors = 'imp.ccsv_colores';
    private string $gamas = 'imp.sm_gamas';

    public function searchArticleMassive($data): array
    {
        return DB::connection($this->connection)
            ->table($this->plProducts . ' as art')
            ->leftJoin($this->plProductsOpc . ' as artO', function ($join) {
                $join->on('art.xarticulo_id', '=', 'artO.xarticulo_id')
                    ->on('art.xempresa_id', '=', 'artO.xempresa_id');
            })
            ->join($this->colors.' as c',function ($join) {
                $join->on('artO.xcolor_id', '=', 'c.xcolor_id')
                    ->on('artO.xempresa_id', '=', 'c.xempresa_id');
            })
            ->join($this->gamas.' as g',function ($join) {
                $join->on('artO.xgama', '=', 'g.xgama_id');
            })
            ->join($this->pcSuppliers.' as pc',function ($join) {
                $join->on('art.xproveedor_id', '=', 'pc.xproveedor_id')
                    ->on('art.xempresa_id', '=', 'pc.xempgen_id');
            })
            ->join($this->plFamilies.' as pf',function ($join) {
                $join->on('art.xfamilia_id', '=', 'pf.xfamilia_id')
                    ->on('art.xempresa_id', '=', 'pf.xempresa_id');
            })
            ->whereIn('art.xarticulo_id',  $data)
            ->select('art.xarticulo_id','art.xdescripcion','art.xproveedor_id','art.xfamilia_id','c.xcolor','artO.xgama','g.xgama as nameGama','artO.xmarca_id','artO.xmedidas','artO.xtarifa_id','artO.xupc','artO.xpeso_bruto','artO.xpeso_neto','artO.xvolumen','artO.xpremedcoste','artO.xpreminimo','artO.xpretarifa','artO.xpretecnico','artO.xuni_caja','artO.xrelleno',
                'artO.xmarca_id','artO.xsizebag','artO.xuni_inner','artO.xporc_arancel','pc.xnombre','pf.xdescripcion')
            ->get()
            ->map(fn($item) => $this->mapListProducts($item))
            ->toArray();
    }
    public function mapListProducts($item): array
    {
        return [
            'id' => $item->xarticulo_id,
            'name' => $item->xdescripcion,
            'supplierId' => $item->xproveedor_id,
            'supplierName' => $item->xnombre,
            'family' => $item->xfamilia_id,
            'nameFamily' => $item->xdescripcion,
            'color' => $item->xcolor,
            'gama' => $item->xgama,
            'nameGama' => $item->nameGama,
            'measure' => $item->xmedidas,
            'tarifa' => $item->xtarifa_id,
            'ean' => $item->xupc,
            'weight' => (float)$item->xpeso_bruto,
            'netWeight' => (float)$item->xpeso_neto,
            'volume' => (float)$item->xvolumen,
            'premedcoste' => $item->xpremedcoste,
            'preminimo' => $item->xpreminimo,
            'pretarifa' => $item->xpretarifa,
            'pretecnico' => $item->xpretecnico,
            'piecesBox' => $item->xuni_caja,
            'relleno' => $item->xrelleno,
            'marcaId' => $item->xmarca_id,
            'sizeBag' => $item->xsizebag,
            'inner' => $item->xuni_inner,
            'arancel' => (float)$item->xporc_arancel
        ];
    }
}
