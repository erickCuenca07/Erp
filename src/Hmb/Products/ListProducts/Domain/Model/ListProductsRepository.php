<?php

namespace Products\ListProducts\Domain\Model;

interface ListProductsRepository
{
    public function search(): mixed;
}
