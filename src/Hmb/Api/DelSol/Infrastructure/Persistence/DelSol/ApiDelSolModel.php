<?php
namespace Api\DelSol\Infrastructure\Persistence\DelSol;

use Exception;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Suppliers\ListSuppliers\Infrastructure\Persistence\Mysql\MysqlListSuppliers;

class ApiDelSolModel
{
    public function login(): mixed
    {
        try {
            $password = env('DELSOL_PASSWORD');
            $encodedPassword = base64_encode($password);
            $response = Http::withOptions(['verify'=>false])->post(env('DELSOL_URL_API_LOGIN'),[
                "codigoFabricante" =>env('DELSOL_COD_MAKER'),
                "codigoCliente" => env('DELSOL_COD_CLIENT'),
                "baseDatosCliente" => env('DELSOL_BD_CLIENT'),
                "password" => $encodedPassword
            ]);
            return json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
    public function getAllSuppliers($token)
    {
        try {
            $url = env('DELSOL_URL_ADMIN').'/LanzarConsulta';
            $response = Http::withOptions(['verify'=>false])-> withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ])->post($url,[
                "ejercicio"=> "2024",
                "consulta"=> "SELECT CODPRO,NOFPRO,NIFPRO,DOMPRO,CPOPRO,PROPRO,TELPRO,FALPRO,PAIPRO FRom F_PRO "
            ]);
            return json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    /**
     * @throws \JsonException
     */
    public function insertQuery($token)
    {
        $listSuppliersFiltered = $this->GetIdListSuppliers();
        $url = env('DELSOL_URL_ADMIN').'/EscribirRegistro';
        $x=[];
        foreach ($listSuppliersFiltered as $value) {
            $x[] = $this->InsertSupplier($url, $token, $value);
        }
        return $x;
    }

    /**
     * @throws \JsonException
     */
    public function InsertSupplier($url, $token, $value)
    {
        try {
            $response = Http::withOptions(['verify'=>false])-> withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ])->post($url,[
                "ejercicio"=> "2024",
                "tabla"=> "F_PRO",
                "registro"=> [
                    ["columna"=>"CODPRO","dato"=> $value['CODPRO']],
                    ["columna"=>"NOFPRO","dato"=> $value['NOFPRO']],
                    ["columna"=>"NIFPRO", "dato"=>$value['NIFPRO']],
                    ["columna"=>"DOMPRO", "dato"=>$value['DOMPRO']],
                    ["columna"=>"CPOPRO", "dato"=>$value['CPOPRO']],
                    ["columna"=>"PROPRO", "dato"=>$value['PROPRO']],
                    ["columna"=>"TELPRO", "dato"=>$value['TELPRO']],
                    ["columna"=>"FALPRO", "dato"=>$value['FALPRO']],
                    ["columna"=>"PAIPRO", "dato"=>$value['PAIPRO']],
                ]
            ]);

        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
        return json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
    }
    public function getListFiltered(): array
    {
        $listSuppliers = new MysqlListSuppliers();
        $listSuppliersArray = $listSuppliers->search();
        foreach ($listSuppliersArray as $key => $value) {
            if ($value['CODPRO'] == '3' || $value['CODPRO'] == '30289' || $value['CODPRO'] == '31034' || $value['CODPRO'] == '31040' || $value['CODPRO'] == '31050' || $value['CODPRO'] == '50020') {
                unset($listSuppliersArray[$key]);
            }
        }
        return array_values($listSuppliersArray);
    }
    public function DeleteQuery($token)
    {
        try {
            $url = env('DELSOL_URL_ADMIN').'/BorrarRegistros/2024/F_PRO/CODPRO= 50025';
            $response = Http::withOptions(['verify'=>false])-> withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get($url);
            return json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
    public function GetIdListSuppliers($id='50013')
    {
        return (new MysqlListSuppliers())->SearchSupplierForId($id);
    }

}
