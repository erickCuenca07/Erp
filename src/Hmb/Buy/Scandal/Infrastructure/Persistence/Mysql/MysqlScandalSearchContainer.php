<?php

namespace Buy\Scandal\Infrastructure\Persistence\Mysql;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchContainer;
use Illuminate\Support\Facades\DB;

class MysqlScandalSearchContainer implements RepositoryScandalSearchContainer
{
    private string $connection = 'mysql';
    private string $tableContainer = 'contenedores';
    public function searchContainer(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->tableContainer.' as c')
            ->select('c.id','c.tamaño','c.precio')
            ->get()
            ->map(fn($item) => $this->mapSearchContainer($item))
            ->toArray();
    }

    public function mapSearchContainer($item): array
    {
        return [
            'idContainer' => $item->id,
            'nameContainer' => $item->tamaño,
            'priceContainer' => $item->precio
        ];
    }
}
