<?php

declare(strict_types=1);

namespace App\Http\Requests\Announcement;

class QueryData
{

    private ?array $fields;
    private string $sortBy;
    private string $sortDir;

    public function __construct(string $sortBy, string $sortDir, ?string $fields)
    {
        $this->fields = $fields ? explode(',', $fields) : [];
        $this->sortBy = $sortBy;
        $this->sortDir = $sortDir;
    }

    public function getFields(): ?array
    {
       return $this->fields;
    }

    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    public function getSortDir(): string
    {
        return $this->sortDir;
    }
}
