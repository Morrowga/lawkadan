<?php

namespace App\Interfaces\System\Auth\API;

use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function login(Request $request);
}
