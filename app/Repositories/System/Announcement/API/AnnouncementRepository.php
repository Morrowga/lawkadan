<?php

namespace App\Repositories\System\Announcement\API;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Announcement;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\System\Auth\API\UserResource;
use App\Http\Resources\System\DisasterData\API\AnnouncementResource;
use App\Interfaces\System\Announcement\API\AnnouncementRepositoryInterface;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    use ApiResponses;

    public function index(Request $request)
    {
        try {

            $type = $request->query('type');

            $nowInYangon = Carbon::now('Asia/Yangon');

            $announcements = Announcement::where('start_date', '<=', $nowInYangon)
                ->where('end_date', '>=', $nowInYangon)
                ->get();

            if ($type == 'announcement') {
                $announcements->whereNull('city_id');
            } else {
                $announcements->whereNotNull('city_id');
            }

            $announcements = $announcements->with('city')->get();


            return $this->success('Announcement successfully fetched.', AnnouncementResource::collection($announcements));

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $announcement = Announcement::create($request->all());

            DB::commit();

            return $this->success('Announcement has been created successfully.', new AnnouncementResource($announcement));

        } catch (\Exception $e) {
            DB::rollback();

            return $this->error($e->getMessage());
        }
    }
}
