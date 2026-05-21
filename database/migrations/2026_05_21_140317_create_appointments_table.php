<?php

use App\Enums\AppointmentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('clinic_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('patient_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('assigned_doctor_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->dateTime('starts_at');

            $table->dateTime('ends_at')
                ->nullable();

            $table->string('status')
                ->default(
                    AppointmentStatus::Scheduled->value
                );

            $table->string('visit_type');

            $table->text('notes_operational')
                ->nullable();

            $table->timestamps();

            $table->index([
                'clinic_id', 'patient_id']);

            $table->index([
                'clinic_id', 'starts_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
