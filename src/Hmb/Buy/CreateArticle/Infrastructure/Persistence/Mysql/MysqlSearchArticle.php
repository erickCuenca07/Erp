<?php

namespace Buy\CreateArticle\Infrastructure\Persistence\Mysql;

use Buy\CreateArticle\Domain\Model\RepositorySearchArticle;
use Illuminate\Support\Facades\DB;

class MysqlSearchArticle implements RepositorySearchArticle
{
    private string $connection = 'sqlsrv';
    private string $articles = 'imp.pl_articulos';
    private string $artOpc = 'imp.pl_articulos_opc';
    private string $colors = 'imp.ccsv_colores';
    public function searchArticle($data): mixed
    {
       $idArticle = $data['idArticle'];
       return DB::connection($this->connection)
           ->table($this->articles.' as art')
           ->join($this->artOpc.' as artOpc',function ($join){
               $join->on('art.xarticulo_id', '=', 'artOpc.xarticulo_id')
               ->whereColumn('art.xempresa_id', '=', 'artOpc.xempresa_id');
           })
            ->join($this->colors.' as c', function ($join) {
                $join->on('artOpc.xcolor_id', '=', 'c.xcolor_id')
                    ->whereColumn('artOpc.xempresa_id', '=', 'c.xempresa_id');
            })
           ->select('art.xdescripcion as nameArticle','artOpc.xvolumen as cbmArticle', 'c.xcolor as colorArticle', 'artOpc.xmedidas as measureArticle', 'artOpc.xrelleno as rellenoArticle', 'artOpc.xmaterial as buildingArticle', 'artOpc.xsizebag as bagMeasureArticle', 'artOpc.xmedidas as boxMeasureArticle', 'artOpc.xuni_caja as piecesBoxArticle', 'artOpc.xmarca_id as brandSelect', 'artOpc.xgama as gamaSelect', 'art.xfamilia_id as familySelect', 'artOpc.xtarifa_id as rateSelect', 'artOpc.xpeso_neto as pesoArticle')
           ->where('art.xarticulo_id', '=', $idArticle)
           ->get()
           ->toArray();
    }
}
