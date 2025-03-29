<?php

namespace App\Http\Controllers\System\Announcement\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\Announcement\API\AnnouncementRequest;
use App\Interfaces\System\Announcement\API\AnnouncementRepositoryInterface;

class AnnouncementController extends Controller
{
    private AnnouncementRepositoryInterface $announcementRepository;

    public function __construct(AnnouncementRepositoryInterface $announcementRepository)
    {
        $this->announcementRepository = $announcementRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $announcements = $this->announcementRepository->index($request);

        return $announcements;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnnouncementRequest $request)
    {
        $createAnnouncement = $this->announcementRepository->store($request);

        return $createAnnouncement;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
