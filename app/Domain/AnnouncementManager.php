<?php

declare(strict_types=1);

namespace App\Domain;

use App\Http\Requests\Announcement\AnnouncementData;
use App\Http\Requests\Announcement\QueryData;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;


class AnnouncementManager
{
    private AnnouncementRepositoryInterface $repository;

    public function __construct(AnnouncementRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getPaginatedList(QueryData $query): LengthAwarePaginator
    {
        return $this->repository->getList($query->getSortBy(), $query->getSortDir());
    }

    public function get(int $id): Announcement
    {
        return $this->repository->getById($id);
    }

    public function store(AnnouncementData $inputData, User $creator): Announcement
    {
       return $this->repository->save($inputData, $creator);
    }
}
