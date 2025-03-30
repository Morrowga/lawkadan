<?php

namespace App\Interfaces\System\Announcement\API;

use Illuminate\Http\Request;

interface AnnouncementRepositoryInterface
{
    public function index(Request $request);

    public function store(Request $request);
}
