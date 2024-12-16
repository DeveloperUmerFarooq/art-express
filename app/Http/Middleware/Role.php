<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->getRoleNames()->first();
            $dashboardRoute = $this->getDashboardRoute($role);
            if ($dashboardRoute) {
                return redirect()->route($dashboardRoute);
            }

            return redirect('/home');
        }

        return redirect()->route('login');
    }

    /**
     * Get the dashboard route based on user role.
     *
     * @param  string  $role
     * @return string|null
     */
    private function getDashboardRoute($role)
    {
        $routes = [
            'admin' => 'admin.dashboard',
            'artist' => 'artist.dashboard',
            'user' => 'user.dashboard',
        ];

        // Return the route name if it exists
        return $routes[$role] ?? null;
    }
}
