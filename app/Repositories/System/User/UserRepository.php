<?php

namespace App\Repositories\System\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Interfaces\System\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function index(Request $request)
    {
        try {

            $users = User::with('city')->paginate(10);

            return $users;

        } catch (\Exception $e) {

            return $this->error($e->getMessage());

        }
    }

    public function status(Request $request,User $user)
    {
        try {

            $user->update([
                "is_active" => $request->status
            ]);

        } catch (\Exception $e) {

            return $this->error($e->getMessage());

        }
    }

    public function delete(User $user)
    {
        try {
            if($user)
            {
                $user->delete();
            }

        } catch (\Exception $e) {

            return $this->error($e->getMessage());
        }
    }

}
