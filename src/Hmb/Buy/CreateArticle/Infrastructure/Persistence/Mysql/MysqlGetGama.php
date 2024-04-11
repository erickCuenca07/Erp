<?php

namespace Buy\CreateArticle\Infrastructure\Persistence\Mysql;

use Buy\CreateArticle\Domain\Model\RepositoryGetGama;
use Illuminate\Support\Facades\DB;

class MysqlGetGama implements RepositoryGetGama
{
    private string $connection='mysql';
    private string $gama = 'gamas';
    public function getGama(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->gama.' as g')
            ->select('g.idGama','g.nameGama')
            ->get()
            ->map(fn($item) => $this->mapGama($item))
            ->toArray();
    }
    public function mapGama($item): array
    {
        return [
            'idGama' => $item->idGama,
            'nameGama' => $item->nameGama
        ];
    }
}
