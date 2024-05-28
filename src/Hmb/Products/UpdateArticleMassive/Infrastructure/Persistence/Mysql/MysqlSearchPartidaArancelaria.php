<?php

namespace Products\UpdateArticleMassive\Infrastructure\Persistence\Mysql;

use Illuminate\Support\Facades\DB;
use Products\UpdateArticleMassive\Domain\Model\RepositorySearchPartidaArancelaria;
class MysqlSearchPartidaArancelaria implements RepositorySearchPartidaArancelaria
{
    private string $connection = 'sqlsrv';
    private string $partidas = 'imp.ccsv_partidas';
    private string $partidasArancelarias = 'imp.rpl_partida_pais';
    public function find(): mixed
    {
        $AllPartida = DB::connection($this->connection)->table($this->partidas.' as p')
            ->select('p.xpartida','p.xpartida_id')
            ->get()
            ->map(fn($item) => $this->mapFind($item))
            ->toArray();
        $PercentagePartida = $this->search();
        return [
            'AllPartida' => $AllPartida,
            'PercentagePartida' => $PercentagePartida
        ];
    }
    public function search (): mixed
    {
        return DB::connection($this->connection)->table($this->partidasArancelarias.' as p')
            ->select('p.xpartida_id','p.xporc_arancel')
            ->where('p.xempresa_id' , '=','SM')
            ->get()
            ->map(fn($item) => $this->mapSearch($item))
            ->toArray();
    }
    public function mapSearch($item): array
    {
        return [
            'id' => $item->xpartida_id,
            'percentage' => $item->xporc_arancel
        ];
    }
    public function mapFind($item): array
    {
        return [
            'partidaId' => $item->xpartida_id,
            'name' => $item->xpartida
        ];
    }
}
