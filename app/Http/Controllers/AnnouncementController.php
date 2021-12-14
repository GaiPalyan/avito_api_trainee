<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\AnnouncementManager;
use App\Exceptions\FailedAnnouncementCreateException;
use App\Http\Requests\Announcement\QueryRequest;
use App\Http\Requests\Announcement\StoreAnnouncementRequest;
use App\Models\Announcement;
use App\Models\User;
use App\View\AnnouncementTransformer;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;

class AnnouncementController extends Controller
{
    private AnnouncementManager $manager;

    public function __construct(AnnouncementManager $manager)
    {
        $this->manager = $manager;
        $this->authorizeResource(Announcement::class, 'announcement');
    }

    public function index(QueryRequest $request): array
    {
        $list = $this->manager->getPaginatedList($request->getQueryRequest());
        return AnnouncementTransformer::transformCollection($list, $request->getQueryRequest()->getFields());
    }

    public function store(StoreAnnouncementRequest $request, Response $response): array
    {
        $creator = auth()->user();
        if (!$creator instanceof User) {
            abort(404);
        }

        try {
            $announcement = $this->manager->store($request->getInputData(), $creator);
        } catch (FailedAnnouncementCreateException $exception) {
             return $exception->getCode();
        }

        $code = $response->getStatusCode();
        return compact('announcement', 'code');
    }

    public function show(Announcement $announcement, QueryRequest $request): array
    {
        $announcement = $this->manager->get($announcement->getAttribute('id'));
        return AnnouncementTransformer::transform($announcement, $request->getQueryRequest()->getFields());
    }
}
