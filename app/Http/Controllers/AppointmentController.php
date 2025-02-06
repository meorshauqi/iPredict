<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of all appointments categorized by status based on user type.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch appointments based on user type
        if ($user->user_type === 'admin') {
            $appointments = Appointment::with(['patient', 'doctor.user'])->get();
        } elseif ($user->user_type === 'doctor') {
            $doctor = $user->doctor;
            if (!$doctor) {
                return redirect()->route('dashboard')->with('error', 'You are not authorized to view appointments.');
            }
            $appointments = Appointment::with(['patient', 'doctor.user'])->where('doctor_id', $doctor->id)->get();
        } else {
            $appointments = Appointment::with(['patient', 'doctor.user'])->where('patient_id', $user->id)->get();
        }

        $pendingAppointments = $appointments->where('status', 'pending');
        $confirmedAppointments = $appointments->where('status', 'confirmed');
        $treatedAppointments = $appointments->where('status', 'treated');
        $cancelledAppointments = $appointments->where('status', 'cancelled');

        return view('appointment.list', compact('appointments', 'pendingAppointments', 'confirmedAppointments', 'treatedAppointments', 'cancelledAppointments'));
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        if ($user->user_type !== 'patient') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to create appointments.');
        }

        $departments = Doctor::distinct()->pluck('department');
        $patientName = $user->name;
        $doctors = Doctor::with('user')->get();

        $bookedSlots = Appointment::with('doctor.user')
            ->whereBetween('appointment_date', [now()->toDateString(), now()->addDays(7)->toDateString()])
            ->get(['appointment_date', 'time_slot', 'doctor_id'])
            ->map(function ($appointment) {
                $timeSlot24Hr = date("H:i:s", strtotime($appointment->time_slot));
                $doctorName = $appointment->doctor->user->name ?? 'Unknown';
                return [
                    'title' => "Not Available - $doctorName",
                    'start' => $appointment->appointment_date . 'T' . $timeSlot24Hr,
                    'color' => '#f05d5e',
                    'allDay' => false,
                ];
            });

        return view('appointment.create', compact('departments', 'patientName', 'doctors', 'bookedSlots'));
    }

    /**
     * Store a new appointment in the database.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->user_type !== 'patient') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to create appointments.');
        }

        $validatedData = $request->validate([
            'doctor_id' => 'nullable|exists:doctors,id', // Doctor selection is optional
            'department' => 'required|exists:doctors,department',
            'appointment_date' => 'required|date',
            'time_slot' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        // Generate all possible 30-minute time slots between 8:00 AM and 6:00 PM
        $allSlots = [];
        $startTime = Carbon::createFromTime(8, 0);
        $endTime = Carbon::createFromTime(18, 0);
        while ($startTime->lt($endTime)) {
            $allSlots[] = $startTime->format('h:i A');
            $startTime->addMinutes(30);
        }

        $doctorId = $request->doctor_id;

        if ($doctorId) {
            // Check if the selected doctor has reached their maximum appointments for the day
            $maxAppointmentsPerDay = 5;
            $appointmentCount = Appointment::where('doctor_id', $doctorId)
                ->where('appointment_date', $request->appointment_date)
                ->count();

            if ($appointmentCount >= $maxAppointmentsPerDay) {
                // Apply round-robin scheduling to find the next available doctor
                $doctors = Doctor::where('department', $request->department)->get();
                if ($doctors->isEmpty()) {
                    return redirect()->back()->with('error', 'No doctors available in the selected department.');
                }

                $doctorAssigned = false;
                foreach ($doctors as $doctor) {
                    $appointmentCount = Appointment::where('doctor_id', $doctor->id)
                        ->where('appointment_date', $request->appointment_date)
                        ->count();

                    if ($appointmentCount < $maxAppointmentsPerDay) {
                        $doctorId = $doctor->id;
                        $doctorAssigned = true;
                        $assignedDoctorName = $doctor->user->name;
                        break;
                    }
                }

                if (!$doctorAssigned) {
                    return redirect()->back()->with('error', 'All doctors in the selected department have reached their maximum appointments for the day.');
                }

                // Update success message for reassigned doctor
                $successMessage = 'The selected doctor is fully booked. You have been assigned to ' . $assignedDoctorName . '. Your appointment has been created successfully.';
            }
        } else {
            $maxAppointmentsPerDay = 5;
            // Round-robin assignment if no doctor is selected
            $doctors = Doctor::where('department', $request->department)->get();
            if ($doctors->isEmpty()) {
                return redirect()->back()->with('error', 'No doctors available in the selected department.');
            }

            $doctorAssigned = false;
            foreach ($doctors as $doctor) {
                $appointmentCount = Appointment::where('doctor_id', $doctor->id)
                    ->where('appointment_date', $request->appointment_date)
                    ->count();

                if ($appointmentCount < $maxAppointmentsPerDay) {
                    $doctorId = $doctor->id;
                    $doctorAssigned = true;
                    $assignedDoctorName = $doctor->user->name;
                    break;
                }
            }

            if (!$doctorAssigned) {
                return redirect()->back()->with('error', 'All doctors in the selected department have reached their maximum appointments for the day.');
            }

            // Update success message for round-robin assigned doctor
            $successMessage = 'You have been assigned to ' . $assignedDoctorName . '. Your appointment has been created successfully.';
        }


        // Check if the time slot is already booked
        $isBooked = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $request->appointment_date)
            ->where('time_slot', $request->time_slot)
            ->exists();

        if ($isBooked) {
            // Suggest alternative time slots
            $bookedAppointments = Appointment::where('doctor_id', $doctorId)
                ->where('appointment_date', $request->appointment_date)
                ->pluck('time_slot')
                ->toArray();

            $suggestedSlots = array_diff($allSlots, $bookedAppointments);

            return redirect()->back()->with([
                'error' => 'The selected date and time are already booked for this doctor.',
                'booked_details' => 'Choose other date and time than ' . implode(', ', $bookedAppointments),
            ]);
        }

        // Create the appointment
        Appointment::create([
            'patient_id' => $user->id,
            'doctor_id' => $doctorId,
            'appointment_date' => $validatedData['appointment_date'],
            'time_slot' => $validatedData['time_slot'],
            'status' => 'pending',
            'notes' => $validatedData['notes'],
        ]);

        return redirect()->route('appointment.create')->with('success', $successMessage ?? 'Appointment created successfully.');
    }



    /**
     * Update the status of an appointment.
     */
    public function updateStatus(Request $request)
    {
        $user = Auth::user();
        if ($user->user_type === 'patient') {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to update appointments.');
        }

        $validatedData = $request->validate([
            'id' => 'required|exists:appointments,id',
            'status' => 'required|in:confirmed,cancelled,treated',
        ]);

        $appointment = Appointment::findOrFail($validatedData['id']);

        if ($user->user_type === 'doctor' && $appointment->doctor_id !== $user->doctor->id) {
            return redirect()->route('dashboard')->with('error', 'You can only update your own appointments.');
        }

        $appointment->update([
            'status' => $validatedData['status'],
        ]);

        return redirect()->back()->with('success', 'Appointment status updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointment.list')->with('success', 'Appointment deleted successfully.');
    }
}
