<?php
namespace Api\DelSol\Infrastructure\Entrypoint\Http;

use Api\DelSol\Application\Handler\HandlerApiDelSol;
use Api\DelSol\Domain\Service\ApiDelSolService;
use Api\DelSol\Infrastructure\Persistence\DelSol\ApiDelSol;
use Inertia\Inertia;
use Inertia\Response;
class ApiDelSolController
{
    public function index(): Response
    {
        $apiDelSol = (new HandlerApiDelSol(
            new ApiDelSolService(new ApiDelSol())
        ))->handler();
        return Inertia::render('Hmb/Api/DelSol/Index', [
            'apiDelSol' => $apiDelSol
        ]);
    }
}
