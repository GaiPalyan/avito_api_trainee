<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\AnnouncementRepositoryInterface;
use App\Exceptions\FailedAnnouncementCreateException;
use App\Http\Requests\Announcement\AnnouncementData;
use App\Models\Announcement;
use App\Models\User;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    public function getList(string $sortBy, string $dir): Paginator
    {
        $basePaginator = Announcement::select('id', 'name', 'description', 'price', 'photo_urls', 'created_at')
            ->orderBy($sortBy, $dir)
            ->paginate(10);

        return new Paginator($basePaginator);
    }

    public function getById(int $id): Announcement
    {
        return Announcement::select('id', 'name', 'description', 'price', 'photo_urls', 'created_at')->findOrFail($id);
    }

    public function save(AnnouncementData $inputData, User $creator): Announcement
    {
        $announcement = Announcement::create([
            'name' => $inputData->getName(),
            'description' => $inputData->getDescription(),
            'price' => $inputData->getPrice(),
            'photo_urls' => $inputData->getPhotos(),
            'created_by_id' => $creator->getAttribute('id')
        ]);

        if (!$announcement) {
            throw new FailedAnnouncementCreateException('Failed to store announcement', 404);
        }

        return $announcement;
    }
}
