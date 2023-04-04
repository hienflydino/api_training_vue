<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use Illuminate\Http\Response as ResponseHttp;

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
                    'success' => true,
                    'message' => 'Success',
                    'code' => Response::HTTP_OK
                ]
            );
        }

        return response()->apiErrors(
            [
                'message' => 'Not found',
                'success' => false,
                'code' => Response::HTTP_OK
            ]
        );
    }

    public function show(User $user, Request $request)
    {
        if ($user) {
            return response()->apiSuccess(
                [
                    'data' => $user,
                    'success' => true,
                    'message' => 'Success',
                    'code' => Response::HTTP_OK
                ]
            );
        }

        return response()->apiErrors(
            [
                'message' => 'Not found',
                'success' => false,
                'code' => Response::HTTP_OK
            ]
        );
    }

    public function store(Request $request)
    {
        $createUser = $this->userService->createUser($request);

        if ($createUser) {
            return response()->apiSuccess(
                [
                    'success' => true,
                    'message' => 'Create Success',
                    'code' => Response::HTTP_OK
                ]
            );
        }

        return response()->apiErrors(
            [
                'success' => false,
                'message' => 'Create Fail',
                'code' => Response::HTTP_OK
            ]
        );
    }

    public function update(Request $request, User $user)
    {
        $updateUser = $this->userService->updateUser($request, $user);

        if ($updateUser) {
            return response()->apiSuccess(
                [
                    'success' => true,
                    'message' => 'Update Success',
                    'code' => Response::HTTP_OK
                ]
            );
        }

        return response()->apiErrors(
            [
                'success' => false,
                'message' => 'Update Fail',
                'code' => Response::HTTP_OK
            ]
        );
    }

    public function destroy(User $user)
    {
        $deleteUser = $this->userService->deleteUser($user);

        if ($deleteUser) {
            return response()->apiSuccess(
                [
                    'success' => true,
                    'message' => 'Delete Success',
                    'code' => Response::HTTP_OK
                ]
            );
        }

        return response()->apiErrors(
            [
                'success' => false,
                'message' => 'Delete Fail',
                'code' => Response::HTTP_OK
            ]
        );
    }
}
