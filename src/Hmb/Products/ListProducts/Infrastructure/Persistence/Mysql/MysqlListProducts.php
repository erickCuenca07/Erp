<?php

namespace Products\ListProducts\Infrastructure\Persistence\Mysql;

use Illuminate\Support\Facades\DB;
use Products\ListProducts\Domain\Model\ListProductsModel;
use Products\ListProducts\Domain\Model\ListProductsRepository;
class MysqlListProducts implements ListProductsRepository
{
    private string $connection = 'sqlsrv';
    private string $plProducts = 'imp.pl_articulos';
    private string $plProductsOpc = 'imp.pl_articulos_opc';
    private string $colors = 'imp.ccsv_colores';
    private string $gamas = 'imp.sm_gamas';
    public function search(): mixed
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
            ->where('art.xfecha_alta', '>=', '2019-01-01')
            ->where('art.xempresa_id', '=', 'SM')
            ->select('art.xarticulo_id','art.xdescripcion','art.xproveedor_id','art.xfamilia_id','c.xcolor','artO.xgama','g.xgama as nameGama','artO.xmarca_id','artO.xmedidas','artO.xtarifa_id','artO.xupc','art.xfecha_alta','art.xusuario_alta')
            ->distinct()
            ->orderBy('art.xfecha_alta', 'desc')
            ->get()
            ->map(fn($item) => $this->mapListProducts($item))
            ->toArray();
    }
    public function mapListProducts($item): array
    {
        return [
            'id' => $item->xarticulo_id,
            'name' => $item->xdescripcion,
            'provider' => $item->xproveedor_id,
            'family' => $item->xfamilia_id,
            'color' => $item->xcolor,
            'gama' => $item->xgama,
            'nameGama' => $item->nameGama,
            'measure' => $item->xmedidas,
            'tarifa' => $item->xtarifa_id,
            'ean' => $item->xupc,
            'date' => $item->xfecha_alta,
            'user' => $item->xusuario_alta
        ];
    }
}
