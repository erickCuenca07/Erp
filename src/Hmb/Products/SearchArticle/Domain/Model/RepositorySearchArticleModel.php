<?php

namespace Products\SearchArticle\Domain\Model;

interface RepositorySearchArticleModel
{
    public function search($search): mixed;
}
