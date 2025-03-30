<?php

namespace App\Http\Controllers\System\Dashboard;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\System\Dashboard\DashboardRepositoryInterface;

class DashboardController extends Controller
{
    private DashboardRepositoryInterface $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function dashboard(Request $request)
    {
        $data = $this->dashboardRepository->dashboard($request);

        return Inertia::render('Dashboard',[
            "data" => $data
        ]);
    }

    public function postApproval(Request $request, Post $post)
    {
        $data = $this->dashboardRepository->postApproval($request, $post);

        return redirect()->back();
    }
}
