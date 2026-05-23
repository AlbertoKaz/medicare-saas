<?php /** @noinspection PhpUnusedLocalVariableInspection */

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Clinic;
use App\Models\ClinicMembership;
use App\Models\User;
use App\Enums\ClinicRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\ClinicalNote;
use App\Enums\PatientStatus;
use App\Enums\AppointmentStatus;
use App\Enums\AppointmentType;
use App\Enums\ClinicalNoteVisibility;
use Illuminate\Support\Carbon;

class MedicalDemoSeeder extends Seeder
{
    public function run(): void
    {
        // -----------------------------
        // 1. Crear Users
        // -----------------------------
        $ownerA = User::create([
            'name' => 'Alice Owner',
            'email' => 'alice.owner@northmedical.test',
            'password' => Hash::make('password'),
        ]);

        $adminA = User::create([
            'name' => 'Laura Admin',
            'email' => 'laura.admin@northmedical.test',
            'password' => Hash::make('password'),
        ]);

        $doctorA = User::create([
            'name' => 'Dr. John Smith',
            'email' => 'john.smith@northmedical.test',
            'password' => Hash::make('password'),
        ]);

        $assistantA = User::create([
            'name' => 'Mike Brown',
            'email' => 'mike.brown@northmedical.test',
            'password' => Hash::make('password'),
        ]);

        $ownerB = User::create([
            'name' => 'Dr. Sarah Lee',
            'email' => 'sarah.lee@southhealth.test',
            'password' => Hash::make('password'),
        ]);

        $doctorB = User::create([
            'name' => 'Dr. Robert King',
            'email' => 'robert.king@southhealth.test',
            'password' => Hash::make('password'),
        ]);

        $intruder = User::create([
            'name' => 'Intruder User',
            'email' => 'intruder@test.com',
            'password' => Hash::make('password'),
        ]);


        // -----------------------------
        // 2. Crear Clinics
        // -----------------------------
        $clinicA = Clinic::create([
            'name' => 'North Medical Center',
            'slug' => 'north-medical',
        ]);

        $clinicB = Clinic::create([
            'name' => 'South Healthcare',
            'slug' => 'south-healthcare',
        ]);


        // -----------------------------
        // 3. Crear Memberships
        // -----------------------------
        ClinicMembership::create([
            'clinic_id' => $clinicA->id,
            'user_id' => $ownerA->id,
            'role' => ClinicRole::Owner,
        ]);

        ClinicMembership::create([
            'clinic_id' => $clinicA->id,
            'user_id' => $adminA->id,
            'role' => ClinicRole::Admin,
        ]);

        ClinicMembership::create([
            'clinic_id' => $clinicA->id,
            'user_id' => $doctorA->id,
            'role' => ClinicRole::Doctor,
        ]);

        ClinicMembership::create([
            'clinic_id' => $clinicA->id,
            'user_id' => $assistantA->id,
            'role' => ClinicRole::Assistant,
        ]);

        ClinicMembership::create([
            'clinic_id' => $clinicB->id,
            'user_id' => $ownerB->id,
            'role' => ClinicRole::Owner,
        ]);

        ClinicMembership::create([
            'clinic_id' => $clinicB->id,
            'user_id' => $doctorB->id,
            'role' => ClinicRole::Doctor,
        ]);

        // Nota: Intruder no tiene membership


        // -----------------------------
        // 4. Crear Patients Clinic A
        // -----------------------------
        $patientA1 = Patient::create([
            'clinic_id' => $clinicA->id,
            'assigned_doctor_id' => $doctorA->id,
            'first_name' => 'Laura',
            'last_name' => 'Gómez',
            'email' => 'laura.gomez@test.com',
            'phone' => '600111222',
            'birth_date' => '1988-04-12',
            'status' => PatientStatus::FollowUp,
            'notes' => 'Patient requires follow-up after last appointment.',
        ]);

        $patientA2 = Patient::create([
            'clinic_id' => $clinicA->id,
            'assigned_doctor_id' => $doctorA->id,
            'first_name' => 'Carlos',
            'last_name' => 'Martínez',
            'email' => 'carlos.martinez@test.com',
            'phone' => '600333444',
            'birth_date' => '1979-09-03',
            'status' => PatientStatus::Active,
            'notes' => 'Active patient with scheduled consultation.',
        ]);

        $patientA3 = Patient::create([
            'clinic_id' => $clinicA->id,
            'assigned_doctor_id' => null,
            'first_name' => 'Marta',
            'last_name' => 'Ruiz',
            'email' => 'marta.ruiz@test.com',
            'phone' => '600555666',
            'birth_date' => '1995-01-20',
            'status' => PatientStatus::Waiting,
            'notes' => 'Waiting for first appointment.',
        ]);


        // -----------------------------
        // 5. Crear Patients Clinic B
        // -----------------------------
        $patientB1 = Patient::create([
            'clinic_id' => $clinicB->id,
            'assigned_doctor_id' => $doctorB->id,
            'first_name' => 'Emma',
            'last_name' => 'Wilson',
            'email' => 'emma.wilson@test.com',
            'phone' => '700111222',
            'birth_date' => '1990-06-18',
            'status' => PatientStatus::InTreatment,
            'notes' => 'Belongs to South Healthcare.',
        ]);

        $patientB2 = Patient::create([
            'clinic_id' => $clinicB->id,
            'assigned_doctor_id' => $doctorB->id,
            'first_name' => 'James',
            'last_name' => 'Taylor',
            'email' => 'james.taylor@test.com',
            'phone' => '700333444',
            'birth_date' => '1982-11-25',
            'status' => PatientStatus::FollowUp,
            'notes' => 'Follow-up patient from Clinic B.',
        ]);


        // -----------------------------
        // 6. Crear Appointments Clinic A
        // -----------------------------
        Appointment::create([
            'clinic_id' => $clinicA->id,
            'patient_id' => $patientA1->id,
            'assigned_doctor_id' => $doctorA->id,
            'starts_at' => Carbon::today()->setTime(10, 00),
            'ends_at' => Carbon::today()->setTime(10, 30),
            'status' => AppointmentStatus::Scheduled,
            'visit_type' => AppointmentType::FollowUp,
            'notes_operational' => 'Follow-up appointment scheduled for today.',
        ]);

        Appointment::create([
            'clinic_id' => $clinicA->id,
            'patient_id' => $patientA2->id,
            'assigned_doctor_id' => $doctorA->id,
            'starts_at' => Carbon::today()->setTime(12, 00),
            'ends_at' => Carbon::today()->setTime(12, 30),
            'status' => AppointmentStatus::Scheduled,
            'visit_type' => AppointmentType::Consultation,
            'notes_operational' => 'Initial consultation.',
        ]);

        Appointment::create([
            'clinic_id' => $clinicA->id,
            'patient_id' => $patientA3->id,
            'assigned_doctor_id' => null,
            'starts_at' => Carbon::tomorrow()->setTime(9, 30),
            'ends_at' => Carbon::tomorrow()->setTime(10, 00),
            'status' => AppointmentStatus::Scheduled,
            'visit_type' => AppointmentType::Consultation,
            'notes_operational' => 'Pending doctor assignment.',
        ]);


        // -----------------------------
        // 7. Crear Appointments Clinic B
        // -----------------------------
        Appointment::create([
            'clinic_id' => $clinicB->id,
            'patient_id' => $patientB1->id,
            'assigned_doctor_id' => $doctorB->id,
            'starts_at' => Carbon::today()->setTime(11, 00),
            'ends_at' => Carbon::today()->setTime(11, 45),
            'status' => AppointmentStatus::Scheduled,
            'visit_type' => AppointmentType::Procedure,
            'notes_operational' => 'Procedure scheduled for South Healthcare.',
        ]);

        Appointment::create([
            'clinic_id' => $clinicB->id,
            'patient_id' => $patientB2->id,
            'assigned_doctor_id' => $doctorB->id,
            'starts_at' => Carbon::tomorrow()->setTime(15, 00),
            'ends_at' => Carbon::tomorrow()->setTime(15, 30),
            'status' => AppointmentStatus::Scheduled,
            'visit_type' => AppointmentType::FollowUp,
            'notes_operational' => 'Tomorrow follow-up.',
        ]);


        // -----------------------------
        // 8. Crear Clinical Notes Clinic A
        // -----------------------------
        ClinicalNote::create([
            'clinic_id' => $clinicA->id,
            'patient_id' => $patientA1->id,
            'author_id' => $doctorA->id,
            'content' => 'Patient reports improvement, but still requires follow-up observation.',
            'visibility' => ClinicalNoteVisibility::Doctor,
        ]);

        ClinicalNote::create([
            'clinic_id' => $clinicA->id,
            'patient_id' => $patientA2->id,
            'author_id' => $doctorA->id,
            'content' => 'Initial assessment completed. No urgent intervention required.',
            'visibility' => ClinicalNoteVisibility::Doctor,
        ]);

        // -----------------------------
        // 9. Crear Clinical Notes Clinic B
        // -----------------------------
        ClinicalNote::create([
            'clinic_id' => $clinicB->id,
            'patient_id' => $patientB1->id,
            'author_id' => $doctorB->id,
            'content' => 'Procedure preparation reviewed. Patient is currently in treatment.',
            'visibility' => ClinicalNoteVisibility::Doctor,
        ]);


        // -----------------------------
        // 10. Crear ActivityLogs Clinic A
        // -----------------------------
        ActivityLog::create([
            'clinic_id' => $clinicA->id,
            'patient_id' => $patientA1->id,
            'actor_id' => $doctorA->id,
            'subject_type' => 'Patient',
            'subject_id' => $patientA1->id,
            'event' => 'patient_created',
            'visibility' => 'operational',
            'payload' => json_encode([
                'patient_name' => $patientA1->full_name,
            ]),
        ]);

        ActivityLog::create([
            'clinic_id' => $clinicA->id,
            'patient_id' => $patientA1->id,
            'actor_id' => $doctorA->id,
            'subject_type' => 'Appointment',
            'subject_id' => 1, // ID de la cita creada previamente
            'event' => 'appointment_scheduled',
            'visibility' => 'operational',
            'payload' => json_encode([
                'starts_at' => Carbon::today()->setTime(10, 00)->toDateTimeString(),
                'doctor_name' => $doctorA->name,
            ]),
        ]);

        ActivityLog::create([
            'clinic_id' => $clinicA->id,
            'patient_id' => $patientA1->id,
            'actor_id' => $doctorA->id,
            'subject_type' => 'ClinicalNote',
            'subject_id' => 1, // ID de la nota creada previamente
            'event' => 'clinical_note_added',
            'visibility' => 'clinical',
            'payload' => json_encode([
                'author_name' => $doctorA->name,
            ]),
        ]);

        // -----------------------------
        // 11. Crear ActivityLogs Clinic B
        // -----------------------------
        ActivityLog::create([
            'clinic_id' => $clinicB->id,
            'patient_id' => $patientB1->id,
            'actor_id' => $doctorB->id,
            'subject_type' => 'Patient',
            'subject_id' => $patientB1->id,
            'event' => 'patient_created',
            'visibility' => 'operational',
            'payload' => json_encode([
                'patient_name' => $patientB1->full_name,
            ]),
        ]);

        ActivityLog::create([
            'clinic_id' => $clinicB->id,
            'patient_id' => $patientB1->id,
            'actor_id' => $doctorB->id,
            'subject_type' => 'Appointment',
            'subject_id' => 4, // ID de la cita creada previamente
            'event' => 'appointment_scheduled',
            'visibility' => 'operational',
            'payload' => json_encode([
                'starts_at' => Carbon::today()->setTime(11, 00)->toDateTimeString(),
                'doctor_name' => $doctorB->name,
            ]),
        ]);

        ActivityLog::create([
            'clinic_id' => $clinicB->id,
            'patient_id' => $patientB1->id,
            'actor_id' => $doctorB->id,
            'subject_type' => 'ClinicalNote',
            'subject_id' => 3, // ID de la nota creada previamente
            'event' => 'clinical_note_added',
            'visibility' => 'clinical',
            'payload' => json_encode([
                'author_name' => $doctorB->name,
            ]),
        ]);
    }
}
