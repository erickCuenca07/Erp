<?php

namespace Buy\CreateArticle\Infrastructure\Persistence\Mysql;

use Buy\CreateArticle\Domain\Model\RepositoryGetClients;
use Illuminate\Support\Facades\DB;

class MysqlGetClients implements RepositoryGetClients
{
    private string $connection = 'mysql';
    private string $clientsGroup = 'grupo_clientes';
    public function getClients(): mixed
    {
        return DB::connection($this->connection)
            ->table($this->clientsGroup.' as c')
            ->select('c.idGroupCli','c.nameGroupCli','c.comision','c.dtoPP','c.dtoFra','c.marca')
            ->get()
            ->map(fn($item) => $this->mapGetClients($item))
            ->toArray();
    }
    public function mapGetClients($item): array
    {
        return[
            'idGroupCli' => $item->idGroupCli,
            'nameGroupCli' => $item->nameGroupCli,
            'commission' => $item->comision,
            'dtoPP' => $item->dtoPP,
            'dtoFra' => $item->dtoFra,
            'marca' => $item->marca
        ];
    }
}
