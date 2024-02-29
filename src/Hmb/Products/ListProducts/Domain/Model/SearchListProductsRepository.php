<?php

namespace Products\ListProducts\Domain\Model;

interface SearchListProductsRepository
{
    public function search(): mixed;
}
