<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponseTrait;
use App\Actions\Users\CreateUserAction;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{

    use ApiResponseTrait;


    public function index()
    {


        $response['user'] = User::where('is_admin', true)->first();
        $response['token'] = $response['user']->createToken("token_name")->plainTextToken;
        return $this->successResponse($response, " token  created");
    }

    public function store(StoreUserRequest $request, CreateUserAction $createUserAction)
    {

        $userData = $request->validated();


        // $userData['start_at'] = Carbon::createFromFormat('m/d/y', $userData['start_at'])->format('Y-m-d');

        $roles = $userData['roles'] ?? [];
        $user = $createUserAction->execute($userData, $roles);




        return $this->successResponse(
            new UserResource($user),
            "user created successfuly",
            Response::HTTP_CREATED,
        );
    }
}
