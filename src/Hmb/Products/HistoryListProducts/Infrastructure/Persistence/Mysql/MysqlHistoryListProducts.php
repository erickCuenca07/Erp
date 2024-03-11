<?php
namespace Products\HistoryListProducts\Infrastructure\Persistence\Mysql;
use Illuminate\Support\Facades\DB;
use Products\HistoryListProducts\Domain\Model\HistoryListProductsRepository;
class MysqlHistoryListProducts implements HistoryListProductsRepository
{
    private string $connection = 'dbServer';
    private string $plProducts = 'imp.pl_articulos';
    private string $plHPedCliCab = 'imp.pl_hpedcli_cab';
    private string $plHPedCliLin = 'imp.pl_hpedcli_lin';
    public function search(): mixed
    {
        return DB::connection($this->connection)
            ->table('imp.pl_hpedcli_lin as hl')
            ->select('hc.xnumdoc_id as idOrder', 'art.xarticulo_id as idArticle', 'art.xdescripcion as nameArticle', 'art.xfecha_alta as dateUp', 'hc.xfecha_pedido as orderDate', 'hc.xfecha_entrega as deliveryDate', 'hl.xcant_ser as quantity')
            ->leftJoin('imp.pl_hpedcli_cab as hc', function($join) {
                $join->on('hl.xempresa_id', '=', 'hc.xempresa_id')
                    ->on('hl.xtipodoc_id', '=', 'hc.xtipodoc_id')
                    ->on('hl.xnumdoc_id', '=', 'hc.xnumdoc_id');
            })
            ->leftJoin('imp.pl_articulos as art', 'hl.xarticulo_id', '=', 'art.xarticulo_id')
            ->where('hc.xfecha_pedido', '>=', '2019-01-01')
            ->where(function ($query) {
                $query->whereNotNull('hl.xcant_ser')
                    ->where('hl.xcant_ser', '!=', 0);
            })
            ->orderByDesc('hc.xfecha_pedido')
            ->orderBy('art.xfecha_alta')
            ->paginate(4000);
    }
}
