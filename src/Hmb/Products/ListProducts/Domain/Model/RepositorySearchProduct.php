<?php

namespace Products\ListProducts\Domain\Model;

interface RepositorySearchProduct
{
    public function search($id): mixed;
}
