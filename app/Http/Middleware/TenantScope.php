<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TenantScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get tenant from request (could be from subdomain, header, or user)
        $tenantId = $this->resolveTenantId($request);

        if ($tenantId) {
            // Set tenant context for the request
            $request->merge(['tenant_id' => $tenantId]);

            // You can also set it in a service container binding
            app()->instance('tenant_id', $tenantId);
        }

        return $next($request);
    }

    /**
     * Resolve tenant ID from request
     */
    protected function resolveTenantId(Request $request): ?int
    {
        // Option 1: From subdomain
        $host = $request->getHost();
        $subdomain = explode('.', $host)[0];

        if ($subdomain && $subdomain !== 'www' && $subdomain !== 'admin') {
            $tenant = \App\Models\Tenant::where('domain', $subdomain)->first();
            if ($tenant) {
                return $tenant->id;
            }
        }

        // Option 2: From header
        if ($request->hasHeader('X-Tenant-ID')) {
            return (int) $request->header('X-Tenant-ID');
        }

        // Option 3: From authenticated user
        if (Auth::check() && Auth::user()->tenant_id) {
            return Auth::user()->tenant_id;
        }

        // Option 4: Default tenant (for single-tenant mode)
        // You can return a default tenant ID or null
        return null;
    }
}

