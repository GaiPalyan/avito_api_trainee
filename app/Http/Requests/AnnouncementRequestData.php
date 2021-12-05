<?php

declare(strict_types=1);

namespace App\Http\Requests;

class AnnouncementRequestData
{
    private string $name;
    private string $description;
    private float $price;
    private array $photo_urls;

    public function __construct
    (
        string $name,
        float $price,
        string $description = null,
        array $photo_urls = null
    )
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->photo_urls = $photo_urls;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPhotos(): ?array
    {
        return $this->photo_urls;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

}