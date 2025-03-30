<?php

namespace App\Repositories\System\Dashboard;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\System\Dashboard\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function dashboard(Request $request)
    {
        try {
            $data = Post::with(['city', 'category'])->paginate($request->per_page ?? 10);

            return $data;

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function postApproval(Request $request, Post $post)
    {
        try {

            $post->update($request->all());

            return $post;

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
