<?php /** @noinspection PhpUnused */

namespace App\Models;

use App\Enums\ClinicRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicMembership extends Model
{
    protected $fillable = [
        'clinic_id',
        'user_id',
        'role',
    ];

    protected function casts(): array
    {
        return [
          'role' => ClinicRole::class,
        ];
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
