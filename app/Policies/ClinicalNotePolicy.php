<?php /** @noinspection PhpUnusedParameterInspection */

namespace App\Policies;

use App\Enums\ClinicRole;
use App\Models\ClinicalNote;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClinicalNotePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $membership = $user
            ->clinicMemberships()
            ->where('clinic_id', currentClinic()?->id)
            ->first();

        if (! $membership) {
            return false;
        }

        return in_array($membership->role, [
            ClinicRole::Owner,
            ClinicRole::Doctor,
        ]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ClinicalNote $clinicalNote): bool
    {
        $membership = $user
            ->clinicMemberships()
            ->where('clinic_id', $clinicalNote->clinic_id)
            ->first();

        if (! $membership) {
            return false;
        }

        return in_array($membership->role, [
            ClinicRole::Owner,
            ClinicRole::Doctor,
        ]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $membership = $user
            ->clinicMemberships()
            ->where('clinic_id', currentClinic()?->id)
            ->first();

        if (! $membership) {
            return false;
        }

        return in_array($membership->role, [
            ClinicRole::Owner,
            ClinicRole::Doctor,
        ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ClinicalNote $clinicalNote): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ClinicalNote $clinicalNote): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ClinicalNote $clinicalNote): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ClinicalNote $clinicalNote): bool
    {
        return false;
    }
}
