<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $listUser = $this->userService->getAllUsers();

        if ($listUser) {
            return response()->apiSuccess(
                [
                    'data' => UserResource::apiPaginate($listUser, $request),
                    'message' => 'Success',
                    'code' => Response::HTTP_OK
                ]
            );
        }

        return response()->apiSuccess(
            [
                'message' => 'Not found',
                'code' => Response::HTTP_OK
            ]
        );
    }
}
