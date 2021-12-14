<?php

declare(strict_types=1);

namespace App\Domain;

interface PaginatorInterface
{
    public function getCollection();
    public function currentPage(): int;
    public function perPage(): int;
    public function total(): int;
}