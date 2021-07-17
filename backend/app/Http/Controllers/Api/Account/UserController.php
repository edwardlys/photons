<?php

namespace App\Http\Controllers\Api\Account;

use App\Http\Controllers\Api\Controller;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Login endpoint.
     *
     * @param LoginRequest $request
     * @param AccountService $accountService 
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function retrieve(Request $request, AccountService $accountService)
    {
        $user = Auth::user();

        return $this->responseSuccess('USER_RETRIEVED', 'Successfully retrieved user information', $user->toArray());
    }
}
