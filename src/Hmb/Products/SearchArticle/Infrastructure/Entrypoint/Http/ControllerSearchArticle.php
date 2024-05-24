<?php

namespace Products\SearchArticle\Infrastructure\Entrypoint\Http;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Products\SearchArticle\Application\Handler\HandlerSearchArticle;
use Products\SearchArticle\Domain\Service\ServiceSearchArticleModel;
use Products\SearchArticle\Infrastructure\Persistence\Mysql\MysqlSearchArticle;

class ControllerSearchArticle
{
    public function index(): Response
    {
        return Inertia::render('Hmb/Products/SearchArticle/Index');
    }

    public function search(Request $request)
    {
        $article = [
            'article' => $request->input('article')
        ];
        return (new HandlerSearchArticle(
            new ServiceSearchArticleModel(new MysqlSearchArticle())
        ))->handle($article);
    }
}
