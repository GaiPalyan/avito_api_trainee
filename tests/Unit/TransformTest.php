<?php

namespace Tests\Unit;

use App\Domain\PaginatorInterface;
use App\Models\Announcement;
use App\View\AnnouncementTransformer;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\Constraint\TraversableContains;
use PHPUnit\Framework\TestCase;

class TransformTest extends TestCase
{
    private Announcement $ann;

    protected function setUp(): void
    {
        $this->ann = new Announcement([
            'id' => null,
            'name' => 'Anno',
            'price' => 15.15,
            'photo_urls' => ['http://www.example.com', 'http://www.example2.com', 'http://www.example3.com'],
            'description' => 'some text',
            'created_by' => 30,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * @param array $expected
     * @param array $fields
     * @return void
     * @dataProvider singleAnnoProvider
     */
    public function testSingleTransform(array $expected, array $fields): void
    {
        $this->assertEquals($expected, AnnouncementTransformer::transform($this->ann, $fields));
    }

    public function testCollectionTransform(): void
    {
        $stub = $this->createMock(PaginatorInterface::class);
        $stub->method('getCollection')->willReturn([
            $this->ann
        ]);
        $stub->method('currentPage')->willReturn(1);
        $stub->method('perPage')->willReturn(10);
        $stub->method('total')->willReturn(1);
        $result = AnnouncementTransformer::transformCollection($stub);
        $this->assertArrayHasKey('meta', $result);
    }

    /**
     * @return array
     */
    public function singleAnnoProvider(): array
    {
        return [
            'empty fields' => [
                [
                    'id' => null,
                    'name' => 'Anno',
                    'price' => 15.15,
                    'photo' => 'http://www.example.com',
                ],
                [null]
            ],

            'fields => description & photo_urls' => [
                [
                    'id' => null,
                    'name' => 'Anno',
                    'price' => 15.15,
                    'photo' => 'http://www.example.com',
                    'photo_urls' => ['http://www.example.com', 'http://www.example2.com', 'http://www.example3.com'],
                    'description' => 'some text',
                ],
                ['description', 'photo_urls']
            ]
        ];
    }
}
