<?php

namespace App\Domain;

use App\Http\Requests\Announcement\AnnouncementData;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface AnnouncementRepositoryInterface
{
    public function getList(string $sortBy, string $dir): LengthAwarePaginator;
    public function getById(int $id): Announcement;
    public function save(AnnouncementData $inputData, User $creator): Announcement;
}