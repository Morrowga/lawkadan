<?php

namespace App\Interfaces\System\Dashboard;

use App\Models\Post;
use Illuminate\Http\Request;

interface DashboardRepositoryInterface
{
    public function dashboard(Request $request);

public function postApproval(Request $request, Post $post);
}
