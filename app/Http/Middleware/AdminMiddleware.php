<?php

namespace App\Http\Middleware;

use Closure;
use Core\Services\UserService;
use Core\Services\GroupService;
use JWTAuth;

/**
 * Class AdminMiddleware
 */
class AdminMiddleware
{
    /**
     * protected $user_service
     */
    protected $user_service;

    /**
     * protected $group_service
     */
    protected $group_service;

    /**
     * [__construct description]
     * @param GroupSerivce $group_service [description]
     * @param UserService  $user_service  [description]
     */
    public function __construct(GroupService $group_service, UserService $user_service)
    {
        $this->group_service = $group_service;
        $this->user_service = $user_service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
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

            if ($profile['id_group'] !== 1) { 
                throw new \Exception("Access Denied Exception", 1);
            } 

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
