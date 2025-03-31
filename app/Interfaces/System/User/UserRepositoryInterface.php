<?php

namespace App\Interfaces\System\User;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function index(Request $request);

    public function status(Request $request,User $user);

}
