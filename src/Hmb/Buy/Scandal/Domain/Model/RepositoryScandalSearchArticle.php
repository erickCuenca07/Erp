<?php

namespace Buy\Scandal\Domain\Model;

interface RepositoryScandalSearchArticle
{
    public function searchArticle($data): mixed;
}
