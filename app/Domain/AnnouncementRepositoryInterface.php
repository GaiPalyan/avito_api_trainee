<?php

namespace App\Domain;

use App\Models\Announcement;
use Illuminate\Pagination\LengthAwarePaginator;

interface AnnouncementRepositoryInterface
{
    public function getList(): LengthAwarePaginator;
    public function getAnnouncement(int $id): Announcement;
    public function save(array $inputData): void;
    public function getStored(): Announcement;
}