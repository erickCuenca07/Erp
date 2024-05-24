<?php
namespace Suppliers\ListSuppliers\Infrastructure\Persistence\Mysql;

use Illuminate\Support\Facades\DB;
use Suppliers\ListSuppliers\Domain\Model\ListSuppliersModel;
use Suppliers\ListSuppliers\Domain\Model\ListSuppliersRepository;
class MysqlListSuppliers implements ListSuppliersRepository
{
    private string $connection = 'mysql';
    private string $suppliers = 'proveedores';
    public function search(): array
    {
        return DB::connection($this->connection)
            ->table($this->suppliers.' as pc')
            ->select('pc.idProveedor', 'pc.nombre','pc.nif','pc.domicilio','pc.cp','pc.provincia','pc.telefono','pc.fechaAlta','pc.pais')
            ->distinct()
            ->get()
            ->map(fn($item) => $this->mapSearch($item)->toArray())
            ->toArray();
    }
    public function mapSearch($item): ListSuppliersModel
    {
        return new ListSuppliersModel(
            $item->idProveedor,
            $item->nombre,
            $item->nif,
            $item->domicilio,
            $item->cp ?? '',
            $item->provincia ?? '',
            $item->telefono ?? '',
            $item->fechaAlta ?? '',
            $item->pais
        );
    }
}
