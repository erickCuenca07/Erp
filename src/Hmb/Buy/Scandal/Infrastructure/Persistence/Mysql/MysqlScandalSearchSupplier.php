<?php

namespace Buy\Scandal\Infrastructure\Persistence\Mysql;

use Buy\Scandal\Domain\Model\RepositoryScandalSearchSupplier;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class MysqlScandalSearchSupplier implements RepositoryScandalSearchSupplier
{
    private string $connection = 'mysql';
    private string $suppliers = 'proveedores';

    public function searchSupplier($data): mixed
    {
        $supplier = DB::connection($this->connection)
            ->table($this->suppliers.' as pc')
            ->select( 'pc.nombre','pc.numPedido')
            ->where('pc.idProveedor',$data['idSupplier'] )
            ->get();
        if ($supplier->count() > 0) {
            return $supplier;
        }
        return throw new RuntimeException(
            'El proveedor '.$data['idSupplier'].' no existe'
        );
    }
}
