<?php

declare(strict_types=1);

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class QueryRequest extends FormRequest
{
    public $query;

    public function rules(): array
    {
        return [

        ];
    }

    public function getQueryRequest(): QueryData
    {
        return new QueryData(
            $this->query('sort') ?? 'id',
            $this->query('dir') ?? 'asc',
            $this->query('fields'),
        );
    }
}