<?php

namespace Tests\Unit;

use App\Domain\AnnouncementManager;
use App\Models\Announcement;
use App\View\AnnouncementTransformer;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\TestCase;

class TransformTest extends TestCase
{
    private array $data;
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
     * @param $expected
     * @param $fields
     * @return void
     * @dataProvider singleAnnoProvider
     */
    public function testSingleTransform($expected, $fields)
    {
        $this->assertEquals($expected, AnnouncementTransformer::transform($this->ann, $fields));
    }

    /*public function testCollectionTransform()
    {
        $stub = $this->createMock(LengthAwarePaginator::class);
        $stub->method('list')->willReturn($this->returnSelf());
        $stub->method('getList')->will();

    }*/

    /**
     * @return array
     */
    public function singleAnnoProvider(): array
    {
        return [
            'with empty fields' => [
                [
                    'id' => null,
                    'name' => 'Anno',
                    'price' => 15.15,
                    'photo' => 'http://www.example.com',
                ],
                [null]
            ],

            'with fields' => [
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
