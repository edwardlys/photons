<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Services\AccountService;

class RegisterController extends Controller
{
    /**
     * Registration endpoint.
     *
     * @param RegisterRequest $request
     * @param AccountService $accountService 
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function register(RegisterRequest $request, AccountService $accountService)
    {
        if ($accountService->createAccount($request->name, $request->email, $request->password)) {
            return $this->responseSuccess('USER_CREATED', 'User account created successfully.');
        }

        return $this->responseError('SERVER_ERROR', 'Unable to create user account at the moment. Please try again later or contact the administrators');
    }
}
