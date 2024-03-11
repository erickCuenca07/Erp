<?php

namespace Products\HistoryListProducts\Domain\Model;

interface HistoryListProductsRepository
{
    public function search(): mixed;
}
