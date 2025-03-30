<?php

namespace App\Http\Controllers\System\Auth\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\Auth\API\LoginApiRequest;
use App\Interfaces\System\Auth\API\AuthRepositoryInterface;

class AuthController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(LoginApiRequest $request)
    {
        $login = $this->authRepository->login($request);

        return $login;
    }
}
