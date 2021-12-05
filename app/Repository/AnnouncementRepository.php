<?php

namespace App\Repository;

use App\Domain\AnnouncementRepositoryInterface;
use App\Models\Announcement;
use Illuminate\Pagination\LengthAwarePaginator;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    public function getList(): LengthAwarePaginator
    {
        return Announcement::select('id', 'name', 'description', 'price', 'photo_urls')
            ->orderBy('price')
            ->paginate(10);
    }

    public function getAnnouncement(int $id): Announcement
    {
        return Announcement::select('id', 'name', 'description', 'photo_urls')->findOrFail($id);
    }

    public function save(array $inputData): void
    {
        $announcement = new Announcement();
        $announcement->fill($inputData);
        $announcement->save();
    }

    public function getStored(): Announcement
    {
        return Announcement::select('id', 'name', 'description', 'photo_urls')->latest()->first();
    }
}
