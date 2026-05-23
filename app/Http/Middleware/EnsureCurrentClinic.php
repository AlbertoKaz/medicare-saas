<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            return redirect()->route('no-clinic');
        }

        session(['current_clinic_id' => $membership->clinic_id]);

        return $next($request);
    }
}
