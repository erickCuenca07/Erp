<?php

namespace Buy\Scandal\Infrastructure\Persistence\Mysql;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchArticle;
use Illuminate\Support\Facades\DB;
class MysqlScandalSearchArticle implements RepositoryScandalSearchArticle
{
    private string $connection = 'sqlsrv';
    private string $article = 'imp.pl_articulos';
    private string $articleOpc = 'imp.pl_articulos_opc';
    private string $colors = 'imp.ccsv_colores';
    private string $articlePrice = 'imp.ccsv_tarifas_art';
    public function searchArticle($data): mixed
    {
        $idArticle = $data['idArticle'];
        $a= DB::connection($this->connection)
            ->table($this->article.' as a')
            ->join($this->articleOpc.' as ao', function ($join) {
                $join->on('a.xarticulo_id', '=', 'ao.xarticulo_id')
                ->whereColumn('a.xempresa_id', '=', 'ao.xempresa_id');
            })
            ->join($this->colors.' as c', function ($join) {
                $join->on('ao.xcolor_id', '=', 'c.xcolor_id')
                ->whereColumn('ao.xempresa_id', '=', 'c.xempresa_id');
            })
            ->select('a.xdescripcion',DB::raw('CASE
                    when ao.xsizebag is not null then ao.xsizebag
                    else ao.xmedidas
                    end as size'),'c.xcolor','ao.xmarca_id','ao.xuni_caja','ao.xtarifa_id','ao.xp_coste','ao.xporc_arancel',
                DB::raw('CASE
                    WHEN ao.xpeso_neto IS NOT NULL AND ao.xpeso_neto != 0.00 THEN ao.xpeso_neto
                    ELSE ao.xpeso_netoa
                END AS xpeso_neto'),'ao.xvolumen'
            )
            ->where('a.xarticulo_id', '=', $idArticle)
            ->get()
            ->map(fn($item) => $this->mapSearchArticle($item))
            ->toArray();
        $b = DB::connection($this->connection)
            ->table($this->article.' as a')
            ->join($this->articlePrice.' as t', function ($join) {
                $join->on('a.xempresa_id', '=', 't.xempresa_id')
                    ->whereColumn('a.xarticulo_id', '=', 't.xarticulo_id');
            })
            ->select('t.xprecio as priceTariff')
            ->where('a.xarticulo_id', '=', $idArticle)
            ->first();
        $c = DB::connection($this->connection)
            ->table($this->article.' as a')
            ->join($this->articlePrice.' as t', function ($join) {
                $join->on('a.xempresa_id', '=', 't.xempresa_id')
                    ->whereColumn('a.xarticulo_id', '=', 't.xarticulo_id');
            })
            ->select('t.xtarifa_id as tariffArticle','t.xprecio as priceTariff')
            ->where('a.xarticulo_id', '=', $idArticle)
            ->get()
            ->toArray();
        if ($b) {
            $a[] = (array) $b;
        }
        if ($c) {
            $a[] = $c;
        }
        return $a;
    }
    public function mapSearchArticle($item): array
    {
        return [
            'nameArticle' => $item->xdescripcion,
            'colorArticle' => $item->xcolor,
            'measureArticle' => $item->size ?? '',
            'brandArticle' => $item->xmarca_id,
            'unitBox' => $item->xuni_caja,
            'tariffArticle' => $item->xtarifa_id,
            'preCost' => $item->xp_coste ?? 0,
            'arancel' => $item->xporc_arancel,
            'weightArticle' => $item->xpeso_neto,
            'cbm' => $item->xvolumen
        ];
    }
}
