<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\IUser;
use App\Http\Requests\User\UserRegistrationRequest;

class AddUserController extends Controller
{
    protected $users;
    public function __construct(IUser $users)
    {
        $this->users = $users;
    }

    public function UserRegistration(UserRegistrationRequest $request) {
        
        $request->validated();

        $addUser = $this->users->create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password'=> Hash::make($request->password),
        ]);

        return new UserResource($addUser);
    }
}
