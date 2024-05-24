<?php

namespace Suppliers\ListCreditors\Domain\Model;

interface ListCreditorsRepository
{

    public function search(): mixed;
}
