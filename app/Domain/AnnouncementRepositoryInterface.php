<?php

namespace App\Domain;

use App\Http\Requests\Announcement\AnnouncementData;
use App\Models\Announcement;
use App\Models\User;
use App\Repository\Paginator;

interface AnnouncementRepositoryInterface
{
    public function getList(string $sortBy, string $dir): Paginator;
    public function getById(int $id): Announcement;
    public function save(AnnouncementData $inputData, User $creator): Announcement;
}