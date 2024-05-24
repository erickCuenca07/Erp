<?php

namespace Families\ListFamilies\Infrastructure\Persistence\Mysql;

use Families\ListFamilies\Domain\Model\ListFamiliesModel;
use Families\ListFamilies\Domain\Model\ListFamiliesRepository;
use Illuminate\Support\Facades\DB;

class MysqlListFamilies implements ListFamiliesRepository
{
    private string $connection = 'mysql';
    private string $plFamilies = 'familias';
    public function search(): mixed
    {
        return DB::connection($this->connection)
          ->table($this->plFamilies . ' as fam')
          ->select('fam.idFamily', 'fam.nameFamily')
          ->get()
          ->map(fn($item) => $this->mapListFamilies($item)->toArray())
          ->toArray();
    }

    public function mapListFamilies($item): ListFamiliesModel
    {
        return new ListFamiliesModel(
            $item->idFamily,
            $item->nameFamily
        );
    }
}
