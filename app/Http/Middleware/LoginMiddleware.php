<?php

namespace App\Http\Middleware;

use Closure;
use Core\Services\UserService;

class LoginMiddleware
{
    protected $user_service;

    public function __construct(UserService $user)
    {
        $this->user_service = $user;
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

            $profile = $this->user_service->findWhere(["remember_token" => $authorization, 'deleted_at' => 0]);
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
