<?php
namespace Api\DelSol\Infrastructure\Persistence\DelSol;

use Exception;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Suppliers\ListSuppliers\Infrastructure\Persistence\Mysql\MysqlListSuppliers;
use Families\ListFamilies\Infrastructure\Persistence\Mysql\MysqlListFamilies;
use Suppliers\ListCreditors\Infrastructure\Persistence\Mysql\MysqlListCreditors;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;


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
                "consulta"=> "SELECT CODPRO,NOFPRO,NIFPRO,DOMPRO,CPOPRO,PROPRO,TELPRO,FALPRO,PAIPRO FRom F_PRO where TIPPRO= 0 "
            ]);
            return json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
    public function getAllCreditors($token)
    {
        try {
            $url = env('DELSOL_URL_ADMIN').'/LanzarConsulta';
            $response = Http::withOptions(['verify'=>false])-> withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ])->post($url,[
                "ejercicio"=> "2024",
                "consulta"=> "SELECT CODPRO,NOFPRO,NIFPRO,DOMPRO,CPOPRO,PROPRO,TELPRO,FALPRO,PAIPRO FRom F_PRO where TIPPRO= 1 "
            ]);
            return json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
    public function getAllFamilies($token)
    {
        try {
            $url = env('DELSOL_URL_ADMIN').'/LanzarConsulta';
            $response = Http::withOptions(['verify'=>false])-> withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token
            ])->post($url,[
                "ejercicio"=> "2024",
                "consulta"=> "SELECT CODFAM,DESFAM FRom F_FAM "
            ]);
            return json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    /**
     * @throws \JsonException
     */
    public function insertFamilies($token): array
    {
        $client = new Client(['verify' => false]);
        $listFamilies= $this->getAllFamiliesSql();
        $url = env('DELSOL_URL_ADMIN').'/EscribirRegistro';
        $promises = [];
        foreach ($listFamilies as $value) {
            $request = new Request('POST', $url, [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ], json_encode([
                "ejercicio" => "2024",
                "tabla" => "F_FAM",
                "registro" => [
                    ["columna" => "CODFAM", "dato" => $value['CODFAM']],
                    ["columna" => "DESFAM", "dato" => $value['DESFAM']]
                ]
            ], JSON_THROW_ON_ERROR));
            $promises[] = $client->sendAsync($request);
        }
        return $this->getResponseApi($promises);
    }
    private function getErrorMessage($reason): string
    {
        if ($reason instanceof RequestException && $reason->getResponse() !== null) {
            return 'HTTP error: ' . $reason->getCode();
        }

        if ($reason instanceof RequestException) {
            return 'Request error: ' . $reason->getMessage();
        }

        return 'Unknown error';
    }
    /**
     * @throws \JsonException
     */
    public function InsertSupplier($token): array
    {
        $client = new Client(['verify' => false]);
        $listSuppliers= $this->getListSupplierFiltered();
        $url = env('DELSOL_URL_ADMIN').'/EscribirRegistro';
        $promises = [];
        foreach ($listSuppliers as $value) {
            $request = new Request('POST', $url, [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ], json_encode([
                "ejercicio" => "2024",
                "tabla" => "F_PRO",
                "registro" => [
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
            ], JSON_THROW_ON_ERROR));
            $promises[] = $client->sendAsync($request);
        }
        return $this->getResponseApi($promises);
    }

    /**
     * @throws \JsonException
     */
    public function insertCreditors($token): array
    {
        $client = new Client(['verify' => false]);
        $listCreditors= $this->getListCreditorsFiltered();
        $url = env('DELSOL_URL_ADMIN').'/EscribirRegistro';
        $promises = [];
        foreach ($listCreditors as $value) {
            $request = new Request('POST', $url, [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ], json_encode([
                "ejercicio" => "2024",
                "tabla" => "F_PRO",
                "registro" => [
                    ["columna"=>"CODPRO","dato"=> $value['CODPRO']],
                    ["columna"=>"TIPPRO","dato"=> 1],
                    ["columna"=>"NOFPRO","dato"=> $value['NOFPRO']],
                    ["columna"=>"NIFPRO", "dato"=>$value['NIFPRO']],
                    ["columna"=>"DOMPRO", "dato"=>$value['DOMPRO']],
                    ["columna"=>"CPOPRO", "dato"=>$value['CPOPRO']],
                    ["columna"=>"PROPRO", "dato"=>$value['PROPRO']],
                    ["columna"=>"TELPRO", "dato"=>$value['TELPRO']],
                    ["columna"=>"FALPRO", "dato"=>$value['FALPRO']],
                    ["columna"=>"PAIPRO", "dato"=>$value['PAIPRO']],
                ]
            ], JSON_THROW_ON_ERROR));
            $promises[] = $client->sendAsync($request);
        }
        return $this->getResponseApi($promises);
    }

    /**
     * @throws \JsonException
     */
    public function getResponseApi(array $promises): array
    {
        $results = Promise\Utils::all($promises)->wait();
        $inserted = [];
        foreach ($results as $result) {
            if ($result->getStatusCode() === 200) {
                $inserted[] = json_decode($result->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
            } else {
                $error = $this->getErrorMessage($result->getReasonPhrase());
                $inserted[] = ['error' => $error];
            }
        }
        return $inserted;
    }
    public function getListSupplierFiltered(): array
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
    public function getListCreditorsFiltered()
    {
        $listCreditors = new MysqlListCreditors();
        $listCreditorsArray = $listCreditors->search();
        foreach ($listCreditorsArray as $key => $value) {
            if ($value['CODPRO'] == '01351' || $value['CODPRO'] == '01352' || $value['CODPRO'] == '01353' || $value['CODPRO'] == '01354' ||
                $value['CODPRO'] == '01355' || $value['CODPRO'] == '01357' || $value['CODPRO'] == '01358' || $value['CODPRO'] == '01359' || $value['CODPRO'] == '01360' || $value['CODPRO'] == '01361') {
                unset($listCreditorsArray[$key]);
            }
        }
        return array_values($listCreditorsArray);
    }
    public function getAllFamiliesSql()
    {
        return (new MysqlListFamilies())->search();
    }

    public function DeleteSuppliersId($token)
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
    public function deleteFamiliesId($token)
    {
        try {
            $url = env('DELSOL_URL_ADMIN').'/BorrarRegistros/2024/F_FAM/CODFAM=94';
            $response = Http::withOptions(['verify'=>false])-> withHeaders([
                'Authorization' => 'Bearer '.$token
            ])->get($url);
            return json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

}
