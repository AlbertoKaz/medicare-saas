<?php

namespace App\Livewire\Dashboard;

use App\Enums\ActivityVisibility;
use App\Enums\PatientStatus;
use App\Models\ActivityLog;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
    public function render(): View
    {
        $clinicId = currentClinic()->id;

        $activePatients = Patient::query()
            ->where('clinic_id', $clinicId)
            ->whereIn('status', [
                PatientStatus::Active,
                PatientStatus::InTreatment,
            ])
            ->count();

        $patientsNeedingAttention = Patient::query()
            ->where('clinic_id', $clinicId)
            ->whereIn('status', [
                PatientStatus::FollowUp,
                PatientStatus::Waiting,
            ])
            ->orderBy('updated_at')
            ->limit(8)
            ->get();

        $patientsFollowUp = Patient::query()
            ->where('clinic_id', $clinicId)
            ->where('status', PatientStatus::FollowUp)
            ->latest('updated_at')
            ->limit(5)
            ->get();

        $todayAppointments = Appointment::query()
            ->where('clinic_id', $clinicId)
            ->whereDate('starts_at', today())
            ->count();

        $appointmentsTodayList = Appointment::query()
            ->where('clinic_id', $clinicId)
            ->with(['patient', 'assignedDoctor'])
            ->whereDate('starts_at', today())
            ->orderBy('starts_at')
            ->limit(8)
            ->get();

        $followUps = Patient::query()
            ->where('clinic_id', $clinicId)
            ->where('status', PatientStatus::FollowUp)
            ->count();

        $recentActivity = ActivityLog::query()
            ->where('clinic_id', $clinicId)
            ->when(
                ! auth()->user()
                    ->can('viewClinicalActivity'),
                fn ($query) => $query->where(
                    'visibility',
                    ActivityVisibility::Operational
                )
            )
            ->latest()
            ->limit(10)
            ->get();

        return view(
            'livewire.dashboard.index',
            compact(
                'activePatients',
                'patientsNeedingAttention',
                'patientsFollowUp',
                'todayAppointments',
                'followUps',
                'recentActivity',
                'appointmentsTodayList',
            )
        );
    }
}
