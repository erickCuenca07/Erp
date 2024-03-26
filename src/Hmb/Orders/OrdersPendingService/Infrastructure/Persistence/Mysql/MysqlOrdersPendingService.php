<?php

namespace Orders\OrdersPendingService\Infrastructure\Persistence\Mysql;

use Exception;
use Illuminate\Support\Facades\DB;
use Orders\OrdersPendingService\Domain\Model\OrdersPendingServiceModel;
use Orders\OrdersPendingService\Domain\Model\OrdersPendingServiceRepository;

class MysqlOrdersPendingService implements OrdersPendingServiceRepository
{
    private string $connection='dbServer';
    private string $plCab = 'imp.pl_pedcli_cab';
    private string $plWayToPay = 'imp.pc_fpago';
    private string $plLin = 'imp.pl_pedcli_lin';
    private string $pcClient = 'imp.pc_clientes';
    private string $plTipDoc = 'imp.pl_tipodoc';
    public function search(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->plCab . ' as cab')
            ->join($this->plWayToPay . ' as way','cab.xfpago_id','=','way.xfpago_id')
            ->join($this->pcClient . ' as cli','cab.xcliente_id','=','cli.xcliente_id')
            ->join($this->plTipDoc . ' as tip',function ($join){
                $join->on('tip.xtipodoc_id','=','cab.xtipodoc_id')
                    ->on('tip.xempresa_id','=','cab.xempresa_id');
            })
            ->select('cab.xnumdoc_id','cab.xcliente_id','cli.xnombre', 'cab.xtipodoc_id','tip.xdescripcion as nameTip','cab.xfecha_pedido','cab.xfecha_entrega','cab.xdivisa_id','cab.xfpago_id','way.xdescripcion')
            ->get()
            ->map(fn ($item) => $this->mapOrdersPending($item)->toArray())
            ->toArray();
    }
    public function getData($order): mixed
    {
       $getOrder = $order['order'];
       return DB::connection($this->connection)
           ->table($this->plLin . ' as lin')
           ->select('lin.xarticulo_id as idArt','lin.xdescripcion as name','lin.xprec_venta as price','lin.xcantidad_prin as quantity','lin.ximporte as amount')
           ->where('lin.xnumdoc_id',$getOrder)
           ->get()
           ->toArray();
    }
    public function mapOrdersPending($item): OrdersPendingServiceModel
    {
        return new OrdersPendingServiceModel(
            $item->xnumdoc_id,
            $item->xcliente_id,
            $item->xnombre,
            $item->xtipodoc_id,
            $item->nameTip,
            $item->xfecha_pedido,
            $item->xfecha_entrega ?? '',
            $item->xdivisa_id,
            $item->xfpago_id,
            $item->xdescripcion
        );
    }


}
