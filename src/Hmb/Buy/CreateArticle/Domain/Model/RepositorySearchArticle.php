<?php

namespace Buy\CreateArticle\Domain\Model;

interface RepositorySearchArticle
{
    public function searchArticle($data): mixed;
}
