<?php

namespace Buy\CreateArticle\Infrastructure\Entrypoint\Http;

use Buy\CreateArticle\Application\Handler\HandlerGetClients;
use Buy\CreateArticle\Application\Handler\HandlerSearchArticle;
use Buy\CreateArticle\Domain\Service\ServiceGetClients;
use Buy\CreateArticle\Domain\Service\ServiceSearchArticle;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetClients;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetRates;
use Buy\CreateArticle\Domain\Service\ServiceGetRates;
use Buy\CreateArticle\Application\Handler\HandlerGetRates;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlSearchArticle;
use Families\ListFamilies\Infrastructure\Persistence\Mysql\MysqlListFamilies;
use Families\ListFamilies\Application\Handler\HandlerListFamilies;
use Families\ListFamilies\Domain\Service\ListFamiliesService;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetGama;
use Buy\CreateArticle\Application\Handler\HandlerGetGama;
use Buy\CreateArticle\Domain\Service\ServiceGetGama;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetBrand;
use Buy\CreateArticle\Application\Handler\HandlerGetBrand;
use Buy\CreateArticle\Domain\Service\ServiceGetBrand;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CreateArticleController
{
    public function createArticle(): Response
    {
        $getClients = (new HandlerGetClients(
            new ServiceGetClients(new MysqlGetClients()))
        )->handle();
        $getRates = (new HandlerGetRates(
            new ServiceGetRates(new MysqlGetRates())
        ))->handle();
        $getFamilies = (new HandlerListFamilies(
            new ListFamiliesService(new MysqlListFamilies())
        ))->handle();
        $getGama = ( new HandlerGetGama(
            new ServiceGetGama(new MysqlGetGama())
        ))->handle();
        $getBrand = (new HandlerGetBrand(
            new ServiceGetBrand(new MysqlGetBrand())
        ))->handle();
        return Inertia::render('Hmb/Buy/CreateArticle/CreateArticle',[
            'clients' => $getClients,
            'rates' => $getRates,
            'families' => $getFamilies,
            'gama' => $getGama,
            'brand' => $getBrand
        ]);
    }
    public function searchArticle(Request $request)
    {
        $data = [
            'idArticle' => $request->input('idArticle'),
        ];
        return (new HandlerSearchArticle(new ServiceSearchArticle(new MysqlSearchArticle())))->handle($data);
    }
}
