<?php

namespace App\Http\Controllers;

use App\Domain\AnnouncementManager;
use App\Exceptions\FailedAnnoCreateException;
use App\Http\Requests\Announcement\QueryRequest;
use App\Http\Requests\Announcement\StoreAnnouncementRequest;
use App\Models\Announcement;
use App\Models\User;
use App\View\AnnouncementTransformer;
use Illuminate\Http\Response;

class AnnouncementController extends Controller
{
    private AnnouncementManager $manager;

    public function __construct(AnnouncementManager $manager)
    {
        $this->manager = $manager;
        $this->authorizeResource(Announcement::class, 'announcement');
    }

    public function index(QueryRequest $request)
    {
        $list = $this->manager->getPaginatedList($request->getQueryRequest());
        return AnnouncementTransformer::transformCollection($list, $request->getQueryRequest()->getFields());
    }

    public function store(StoreAnnouncementRequest $request, Response $response)
    {
        $creator = auth()->user();
        if (!$creator instanceof User) {
            abort(404);
        }

        try {
             $anno = $this->manager->store($request->getInputData(), $creator);
        } catch (FailedAnnoCreateException $exception) {
             return $exception->getCode();
        }

        $code = $response->getStatusCode();
        return compact('anno', 'code');
    }

    public function show(Announcement $announcement, QueryRequest $request)
    {
        $anno = $this->manager->get($announcement->getAttribute('id'));
        return AnnouncementTransformer::transform($anno, $request->getQueryRequest()->getFields());
    }
}
