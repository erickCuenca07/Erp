<?php

namespace Products\SearchArticle\Infrastructure\Persistence\Mysql;

use Illuminate\Support\Facades\DB;
use Products\SearchArticle\Domain\Model\RepositorySearchArticleModel;
use Products\SearchArticle\Domain\Model\SearchArticleModel;

class MysqlSearchArticle implements RepositorySearchArticleModel
{
    private string $connection = 'dbServer';
    private string $articles = 'imp.pl_articulos';
    private string $stock = 'imp.pl_existalm';
    private string $store ='imp.pl_almacenes';

    public function search($search): mixed
    {
        $searchId = $search['article'];
        return DB::connection($this->connection)
            ->table($this->stock.' as st')
            ->join($this->articles.' as ar', 'st.xarticulo_id', '=', 'ar.xarticulo_id')
            ->join($this->store.' as al', 'st.xalmacen_id', '=', 'al.xalmacen_id')
            ->where('st.xempresa_id', '=', 'SM')
            ->where('al.xempresa_id', '=', 'SM')
            ->where('st.xarticulo_id', '=', $searchId)
            ->select('st.xarticulo_id','ar.xdescripcion as name','st.xexistencia','st.xpte_recibir','st.xpte_servir','st.xalmacen_id','al.xdescripcion')
            ->get()
            ->map(fn($item) => $this->mapSearch($item)->toArray())
            ->toArray();

    }
    public function mapSearch($item): SearchArticleModel
    {
        return new SearchArticleModel(
            $item->xarticulo_id,
            $item->name,
            $item->xexistencia,
            $item->xpte_recibir,
            $item->xpte_servir,
            $item->xalmacen_id,
            $item->xdescripcion ?? ''
        );
    }
}
