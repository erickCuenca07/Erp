<?php

namespace Products\SearchArticleMassive\Domain\Model;

interface RepositorySearchArticleMassive
{
    public function searchArticleMassive($data): mixed;
}
