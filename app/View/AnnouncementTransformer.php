<?php

declare(strict_types=1);

namespace App\View;

use App\Domain\PaginatorInterface;
use App\Models\Announcement;

class AnnouncementTransformer
{
    public static function transform(Announcement $announcement, array $fields = []): array
    {
        $data = [
            'id' => $announcement->getAttribute('id'),
            'name' => $announcement->getAttribute('name'),
            'price' => $announcement->getAttribute('price'),
            'photo' => $announcement->getMainPhoto(),
        ];

        $filled = self::additionFields($announcement, $fields);
        return array_merge($data, $filled);
    }

    private static function additionFields(Announcement $announcement, array $fields = []): array
    {
        $data = [];
        array_map(static function($fieldValue, $fieldName) use (&$data, $fields) {
            if (in_array($fieldName, $fields, true)) {
                $data[$fieldName] = $fieldValue;
            }
        }, $announcement->toArray(), array_keys($announcement->toArray()));

        return $data;
    }

    public static function transformCollection(PaginatorInterface $list, array $fields = []): array
    {
        $collection = [];
        foreach ($list->getCollection() as $announcement) {
            $collection[] = self::transform($announcement, $fields);
        }

        $meta['page'] = $list->currentPage();
        $meta['count'] = $list->perPage();
        $meta['overall'] = $list->total();

        return compact('collection', 'meta');
    }
}
