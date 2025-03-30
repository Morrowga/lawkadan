<?php

namespace App\Repositories\System\Auth\API;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\System\Auth\API\UserResource;
use App\Interfaces\System\Auth\API\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    use ApiResponses;

    public function login(Request $request)
    {
        try {

            // return $ip = $request->ip();
            $user = User::with('city')->where('msisdn', $request->msisdn)->first();

            if ($user) {
                if (!Hash::check($request->password, $user->password)) {
                    return $this->error('Incorrect password.', 401);
                }
            } else {
                $randomName = 'User@' . Str::random(5);

                $user = User::create([
                    'name' => $randomName,
                    'msisdn' => $request->msisdn,
                    'ip' => $request->ip,
                    'city_id' => $request->city_id,
                    'is_active' => true,
                    'password' => Hash::make($request->password),
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->success('User successfully logged in.', new UserResource($user), $token);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
