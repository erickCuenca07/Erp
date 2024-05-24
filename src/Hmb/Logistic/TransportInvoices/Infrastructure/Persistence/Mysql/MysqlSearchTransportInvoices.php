<?php

namespace Logistic\TransportInvoices\Infrastructure\Persistence\Mysql;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Logistic\TransportInvoices\Domain\Model\RepositorySearchTransportInvoices;

class MysqlSearchTransportInvoices implements RepositorySearchTransportInvoices
{
    private string $connection = 'sqlsrv';
    private string $albCab = 'imp.pl_halbcli_cab';
    private string $albLin = 'imp.pl_halbcli_lin';
    private string $articleOpc = 'imp.pl_articulos_opc';
    private string $client = 'imp.pc_clientes';
    private string $provinces = 'imp.pc_provincias';
    private string $transporte = 'imp.pl_medios';
    private string $representante = 'imp.pl_representantes';
    public function search($data): mixed
    {
        $dataInvoice = $this->searchLineInvoice($data);
        $concepInvoice = $this->searchConcepInvoice($data);
        foreach ($concepInvoice as $key => $value) {
            if (isset($dataInvoice[$key]) && !empty($value)) {
                foreach ($value as $item) {
                    $dataInvoice[$key]['concep'] = $item->concep ?? '';
                    $dataInvoice[$key]['import'] = $item->import ?? '';
                }
            } else {
                $dataInvoice[$key]['concep'] = '';
                $dataInvoice[$key]['import'] = '';
            }
        }
        return $dataInvoice;
    }
    public function searchConcepInvoice($data)
    {
        $numAlb = $this->searchInvoice($data);
        $result = [];
        foreach ($numAlb as $item) {
            $result[$item->numAlb] =DB::connection($this->connection)
                ->table($this->albLin.' as lin')
                ->select('lin.xconcepto_id as concep','lin.ximporte as import','lin.xnumdoc_id as numAlb')
                ->where('lin.xnumdoc_id', $item->numAlb)
                ->where('lin.xconcepto_id', '=','008')
                ->get()
                ->toArray();
        }
        return $result;
    }
    public function searchInvoice($data): mixed
    {
        $dataStart = $data['dateStart'];
        $dataEnd = $data['dateEnd'];
        return DB::connection($this->connection)
            ->table($this->albCab.' as cab')
            ->select('cab.xnumdoc_id as numAlb')
            ->where('cab.ximporte', '>', 0)
            ->whereBetween('cab.xfecha_albaran', [$dataStart, $dataEnd])
            ->get()
            ->toArray();
    }
    public function searchLineInvoice($data)
    {
        $numAlb = $this->searchInvoice($data);
        $data =[];
        $result = [];
        foreach ($numAlb as $item) {
            $data[] = DB::connection($this->connection)
                ->table($this->albLin.' as lin')
                ->join($this->articleOpc.' as a', function ($join) {
                    $join->on('lin.xarticulo_id', '=', 'a.xarticulo_id')
                        ->whereColumn('lin.xempresa_id', '=', 'a.xempresa_id');
                })
                ->join($this->albCab.' as h', function ($join) {
                    $join->on('lin.xnumdoc_id', '=', 'h.xnumdoc_id')
                        ->whereColumn('lin.xempresa_id', '=', 'h.xempresa_id')
                        ->whereColumn('lin.xciclo_id', '=', 'h.xciclo_id');
                })
                ->join($this->client.' as c',function ($join){
                    $join->on('h.xcliente_id', '=', 'c.xcliente_id')
                        ->whereColumn('h.xempresa_id', '=', 'c.xempgen_id');
                })
                ->join($this->representante.' as r',function ($join){
                    $join->on('h.xrepresentante_id', '=', 'r.xrepresentante_id')
                        ->whereColumn('h.xempresa_id', '=', 'r.xempresa_id');
                })
                ->join($this->provinces.' as p','c.xprovincia_id', '=', 'p.xprovincia_id')
                ->join($this->transporte.' as m','h.xmedio_id', '=', 'm.xmedio_id')
                ->select('lin.xbultos as bultos','lin.xcantidad_prin as quantity',DB::raw("MIN(CASE WHEN h.ximporte < h.xbase_imp_db THEN h.ximporte ELSE h.xbase_imp_db END) AS import"), 'lin.xconcepto_id as concep','lin.xdescripcion as descrip','lin.xnumdoc_id as numAlb',
                'a.xpeso_neto as pesoNeto','a.xvolumen as volumen','a.xsizebag as sizeBag','a.xuni_caja as unitBag','h.xmedio_id as medioId','h.xcliente_id as clienteId','h.xfpago_id as paymed','h.xrepresentante_id as repreId','r.xnombre as repreName','m.xnombre as nameMedio',
                'c.xnombre as clientName','h.xfecha_albaran as dateAlbaran','p.xnombre as provinceName','c.xpoblacion as populationName','h.xreferencia as reference','h.xtotal_neto as totalCosteNeto')
                ->groupBy('lin.xbultos','lin.xcantidad_prin','lin.ximporte','lin.xconcepto_id','lin.xdescripcion','lin.xnumdoc_id','a.xpeso_neto','a.xvolumen','a.xsizebag','a.xuni_caja','h.xmedio_id','h.xcliente_id',
                    'h.xfpago_id','h.xrepresentante_id','r.xnombre','m.xnombre','h.xfecha_albaran','c.xnombre','p.xnombre','c.xpoblacion','h.xreferencia','h.xtotal_neto')
                ->where('lin.xnumdoc_id', $item->numAlb)
                ->get()
                ->toArray();
        }
        foreach ($data as $item) {
            foreach ($item as $value) {
                $carbonDate = new Carbon($value->dateAlbaran);
                if (!isset($result[$value->numAlb])) {
                    $result[$value->numAlb] = [
                        'medioId' => $value->medioId,
                        'nameMedio' => $value->nameMedio,
                        'dateAlbaran' => $carbonDate->format('d-m-Y'),
                        'clientId' => $value->clienteId,
                        'clientName' => $value->clientName,
                        'provincesName' => $value->provinceName,
                        'populationName' => $value->populationName,
                        'reference' => $value->reference,
                        'totalBultos' => 0,
                        'totalPesoNeto' => 0,
                        'totalVolumen' => 0,
                        'FPago' => $value->paymed,
                        'nºAlb' => 1,
                        'totalImport' => (float)$value->import,
                        'numAlb' => $value->numAlb,
                        'repreId' => $value->repreId,
                        'repreName' => $value->repreName,
                        'totalCosteNeto' => (float)$value->totalCosteNeto,
                    ];
                }
                $result[$value->numAlb]['totalBultos'] += (int)$value->bultos;
                $result[$value->numAlb]['totalPesoNeto'] += (float)$value->pesoNeto;
                $result[$value->numAlb]['totalVolumen'] += (float)$value->volumen;
            }
        }
        return $result;
    }
}
