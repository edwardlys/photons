<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *   title="Photons API",
 *   version="1.0.0",
 *   @OA\Contact(
 *     email="elys.1993a@gmail.com"
 *   )
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return a success response with the following configuration
     *
     * @param  string $code    The response code. Pre-configured response for an action.
     * @param  string $message Response message to communicate to the a certain result.
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function responseSuccess(string $code = 'SUCCESS', string $message = 'Success', array $data = [])
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], 200);
    }

    /**
     * Return a error response with the following configuration
     *
     * @param  string $code    The response code. Pre-configured response for an action.
     * @param  string $message Response message to communicate to the a certain result.
     * 
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
     */
    public function responseError(string $code = 'ERROR', string $message = 'Error', array $data = [])
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], 500);
    }
}
