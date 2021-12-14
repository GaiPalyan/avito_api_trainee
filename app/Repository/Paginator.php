<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\PaginatorInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginator implements PaginatorInterface
{

    private LengthAwarePaginator $paginator;

    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function getCollection(): \Traversable
    {
        return $this->paginator->getCollection();
    }

    public function currentPage(): int
    {
        return $this->paginator->currentPage();
    }

    public function perPage(): int
    {
        return $this->paginator->perPage();
    }

    public function total(): int
    {
        return $this->paginator->total();
    }
}
