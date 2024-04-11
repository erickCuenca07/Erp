<?php

namespace Buy\CreateArticle\Infrastructure\Persistence\Mysql;

use Buy\CreateArticle\Domain\Model\RepositoryGetBrand;
use Illuminate\Support\Facades\DB;

class MysqlGetBrand implements RepositoryGetBrand
{
    private string $connection='mysql';
    private string $tableBrand='marcas';
    public function getBrand(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->tableBrand.' as m')
            ->select('m.idBrand','m.nameBrand')
            ->get()
            ->map(fn($item) => $this->mapBrand($item))
            ->toArray();
    }
    public function mapBrand($item): array
    {
        return [
            'idBrand' => $item->idBrand,
            'nameBrand' => $item->nameBrand
        ];
    }

}
