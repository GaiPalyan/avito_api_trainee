<?php

declare(strict_types=1);

namespace App\View;

use App\Models\Announcement;
use Illuminate\Pagination\LengthAwarePaginator;

class AnnouncementTransformer
{
    public static function transform(Announcement $ann, array $fields = null): array
    {
        $data = [
            'id' => $ann->getAttribute('id'),
            'name' => $ann->getAttribute('name'),
            'price' => $ann->getAttribute('price'),
            'photo' => $ann->getMainPhoto(),
        ];

        if ($fields) {
            array_map(static function($fieldValue, $fieldName) use (&$data, $fields) {
               if (in_array($fieldName, $fields, true)) {
                   $data[$fieldName] = $fieldValue;
               }
            }, $ann->toArray(), array_keys($ann->toArray()));
        }

        return $data;
    }

    public static function transformCollection(LengthAwarePaginator $list, array $fields = null): array
    {
        $collection = $list->getCollection()->map(fn($ann) => self::transform($ann, $fields));
        $meta['page'] = $list->currentPage();
        $meta['count'] = $list->perPage();
        $meta['overall'] = $list->total();

        return compact('collection', 'meta');
    }
}
