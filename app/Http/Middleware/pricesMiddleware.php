<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class pricesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $station = $request->route('station');

        if($station->status=='deactive'){
            return redirect()->route('admin.displayprices')->with('Error','You cannot update this prices');
        }
        return $next($request);
    }
}
