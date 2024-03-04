<?php
namespace Api\DelSol\Infrastructure\Persistence\DelSol;
use Exception;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class ApiDelSolModel
{

    public function login(): string
    {
        $password = env('DELSOL_PASSWORD');
        $encodedPassword = base64_encode($password);
        $body = json_encode([
            "codigoFabricante" => env('DELSOL_COD_FABRICANTE'),
            "codigoCliente" => env('DELSOL_COD_CLIENTE'),
            "baseDatosCliente" => env('DELSOL_BD_CLIENTE'),
            "password" => $encodedPassword
        ], JSON_THROW_ON_ERROR);

        $response = Http::withOptions(['verify' => false])->post(env('DELSOL_URL_API') . '/login/Autenticar' , [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => $body
        ]);
        try {
            if ($response->successful()) {
                return $response->body();
            }
        }catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}
