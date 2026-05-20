<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCurrentClinic
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        $currentClinicId = session('current_clinic_id');

        if (
            $currentClinicId &&
            $user->clinicMemberships()
                ->where('clinic_id', $currentClinicId)
                ->exists()
        ) {
            return $next($request);
        }

        $membership = $user->clinicMemberships()
            ->with('clinic')
            ->first();

        if (! $membership) {
            session()->forget('current_clinic_id');

            abort(403, 'You do not belong to any clinic.');
        }

        session(['current_clinic_id' => $membership->clinic_id]);

        return $next($request);
    }
}
