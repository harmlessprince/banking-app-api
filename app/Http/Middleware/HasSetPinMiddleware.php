<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasSetPinMiddleware
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = $request->user();
        $userService = new UserService();
        if (!$userService->hasSetPin($user)){
            return  $this->sendError('Please set your pin', 401);
        }
        return $next($request);
    }
}
