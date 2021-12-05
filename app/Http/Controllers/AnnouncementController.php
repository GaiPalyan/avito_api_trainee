<?php

namespace App\Http\Controllers;

use App\Domain\AnnouncementManager;
use App\Http\Requests\StoreAnnouncementRequest;
use Illuminate\Http\Response;

class AnnouncementController extends Controller
{
    private AnnouncementManager $manager;

    public function __construct(AnnouncementManager $manager)
    {
        $this->manager = $manager;
    }

    public function index()
    {
        return $this->manager->getPaginatedList();
    }

    public function store(StoreAnnouncementRequest $request, Response $response)
    {
        $this->manager->storeAnnouncement($request->getInputData()->toArray());
        $announcement = $this->manager->getStoredAnnouncement()->toArray();
        $code = $response->getStatusCode();
        return $announcement ? compact('announcement', 'code') : $code;
    }

    public function show(int $id)
    {
        $request = request()->request;
        return $this->manager->getSingleAnnouncement($id);
    }
}
