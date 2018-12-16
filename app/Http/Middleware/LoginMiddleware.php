<?php

namespace App\Http\Middleware;

use Closure;
use Core\Services\UserService;
use JWTAuth;

/**
 * Class LoginMiddleware
 */
class LoginMiddleware
{
    /**
     * protected $user_service
     */
    protected $user_service;

    /**
     * [__construct description]
     * @param UserService $user [description]
     */
    public function __construct(UserService $user)
    {
        $this->user_service = $user;
    }

    /**
     * Check user login
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try
        {
            $authorization = $request->header('authorization');

            JWTAuth::setToken($authorization);

            $profile = JWTAuth::authenticate();
            
            $profile = $this->user_service->find($profile->id);

            return $next($request);
        } catch(\Exception $e) {
            // Return json
            return response()->json([
                "result_code"       => 403,
                "result_message"    => "Access Denied Exception",
                "data"              => null
            ], 403);
        }
    }
}
