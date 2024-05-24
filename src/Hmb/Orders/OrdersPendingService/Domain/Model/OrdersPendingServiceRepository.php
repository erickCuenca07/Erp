<?php

namespace Orders\OrdersPendingService\Domain\Model;

interface OrdersPendingServiceRepository
{
    public function search(): mixed;
    public function getData($order): mixed;
}
