<?php

namespace Buy\Scandal\Domain\Model;

interface RepositoryScandalSearchSupplier
{
    public function searchSupplier($data): mixed;
}
