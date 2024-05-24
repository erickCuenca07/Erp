<?php

namespace Products\SearchArticle\Application\Handler;

use Products\SearchArticle\Domain\Service\ServiceSearchArticleModel;

class HandlerSearchArticle
{
    public function __construct(
        private readonly ServiceSearchArticleModel $service
    ){}

    public function handle($search): mixed
    {
        return $this->service->execute($search);
    }
}
