<?php

namespace Buy\CreateArticle\Infrastructure\Persistence\Mysql;

use Buy\CreateArticle\Domain\Model\RepositoryGetRates;
use Illuminate\Support\Facades\DB;

class MysqlGetRates implements RepositoryGetRates
{
    private string $connection="mysql";
    private string $rates="tarifas";
    public function getRates(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->rates)
            ->select('idRate', 'nameRate')
            ->get()
            ->map(fn($item) => $this->mapRates($item))
            ->toArray();
    }
    public function mapRates($item): array
    {
        return [
            'idRate' => $item->idRate,
            'nameRate' => $item->nameRate
        ];
    }
}
