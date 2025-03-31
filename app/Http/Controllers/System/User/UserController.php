<?php

namespace App\Http\Controllers\System\User;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\System\User\UserRepositoryInterface;

class UserController extends Controller
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->index($request);

        return Inertia::render('System/User/Index', [
            "users" => $users
        ]);
    }

    public function status(Request $request,User $user)
    {
        $users = $this->userRepository->status($request, $user);

        return redirect()->back();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit(User $user)
    {

    }

    public function update(Request $request, User $user)
    {

    }

    /**
        * Remove the specified resource from storage.
        */
    public function destroy(User $user)
    {
        $deleteUser = $this->userRepository->delete($user);

        return redirect()->back();
    }
}
