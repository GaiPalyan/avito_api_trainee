<?php

namespace App\Repository;

use App\Domain\AnnouncementRepositoryInterface;
use App\Exceptions\FailedAnnoCreateException;
use App\Http\Requests\Announcement\AnnouncementData;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    public function getList(string $sortBy, string $dir): LengthAwarePaginator
    {
        return Announcement::select('id', 'name', 'description', 'price', 'photo_urls', 'created_at')
            ->orderBy($sortBy, $dir)
            ->paginate(10);
    }

    public function getById(int $id): Announcement
    {
        return Announcement::select('id', 'name', 'description', 'price', 'photo_urls', 'created_at')->findOrFail($id);
    }

    public function save(AnnouncementData $inputData, User $creator): Announcement
    {
        $anno = Announcement::create([
            'name' => $inputData->getName(),
            'description' => $inputData->getDescription(),
            'price' => $inputData->getPrice(),
            'photo_urls' => $inputData->getPhotos(),
            'created_by_id' => $creator->getAttribute('id')
        ]);

        if (!$anno) {
            throw new FailedAnnoCreateException('Failed to store announcement', 404);
        }

        return $anno;
    }
}
