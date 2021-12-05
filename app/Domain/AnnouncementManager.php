<?php

declare(strict_types=1);

namespace App\Domain;

class AnnouncementManager
{
    private AnnouncementRepositoryInterface $repository;

    public function __construct(AnnouncementRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getPaginatedList(): array
    {
        $list = $this->repository->getList();
        $data = $list->getCollection()->map(function ($announcements) {
            $mainPhoto = $this->getMainPhoto($announcements->getAttribute('photo_urls'));
            $announcement = collect($announcements)->except('photo_urls')->toArray();
            $announcement['photo'] = $mainPhoto;
            return $announcement;
        })->toArray();

        $meta['page'] = $list->currentPage();
        $meta['count'] = $list->perPage();
        $meta['overall'] = $list->total();

        return compact('data', 'meta');
    }

    public function getSingleAnnouncement(int $id): array
    {
        $announcement = $this->repository->getAnnouncement($id);
        $mainPhoto = $this->getMainPhoto($announcement->getAttribute('photo_urls'));
        $announcement = $announcement->toArray();
        $announcement['photo'] = $mainPhoto;

        return $announcement;
    }

    public function storeAnnouncement(array $inputData): void
    {
        $this->repository->save($inputData);
    }

    public function getStoredAnnouncement()
    {
        return $this->repository->getStored();
    }

    private function getMainPhoto(array $photos): string
    {
        return reset($photos);
    }

}
