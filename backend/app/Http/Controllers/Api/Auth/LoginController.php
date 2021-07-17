<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Services\AccountService;

class LoginController extends Controller
{
    /**
     * Login endpoint.
     *
     * @param LoginRequest $request
     * @param AccountService $accountService 
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function login(LoginRequest $request, AccountService $accountService)
    {
        if ($tokens = $accountService->requestToken($request->email, $request->password)) {
            return $this->responseSuccess('TOKEN_REQUEST_SUCCESS', 'Token successfully retrieved.', $tokens);
        }

        return $this->responseError('TOKEN_REQUEST_FAIL', 'Token was not generated. Check your credentials. If problem persists, contact the administrator.');
    }
}
