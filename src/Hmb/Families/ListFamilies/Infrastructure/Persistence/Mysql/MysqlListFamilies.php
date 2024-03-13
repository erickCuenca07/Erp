<?php

namespace Families\ListFamilies\Infrastructure\Persistence\Mysql;

use Families\ListFamilies\Domain\Model\ListFamiliesModel;
use Families\ListFamilies\Domain\Model\ListFamiliesRepository;
use Illuminate\Support\Facades\DB;

class MysqlListFamilies implements ListFamiliesRepository
{
    private string $connection = 'dbServer';
    private string $plFamilies = 'imp.pl_familias';
    private string $plArticles = 'imp.pl_articulos';
    public function search(): mixed
    {
        return DB::connection($this->connection)
          ->table($this->plFamilies . ' as fam')
          ->leftJoin($this->plArticles . ' as art', function ($join) {
              $join->on('fam.xfamilia_id', '=', 'art.xfamilia_id')
                  ->on('art.xempresa_id', '=', 'fam.xempresa_id');
          })
          ->where('art.xfecha_alta', '>=', '2019-01-01')
            ->where('art.xempresa_id', '=', 'SM')
          ->select('fam.xfamilia_id', 'fam.xdescripcion')
          ->distinct()
          ->orderBy('fam.xfamilia_id', 'asc')
          ->get()
          ->map(fn($item) => $this->mapListFamilies($item)->toArray())
          ->toArray();
    }

    public function mapListFamilies($item): ListFamiliesModel
    {
        return new ListFamiliesModel(
            $item->xfamilia_id,
            $item->xdescripcion
        );
    }
}
