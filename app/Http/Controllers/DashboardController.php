<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Shared Data: Patient registrations for the last 12 months
        $patientRegistrations = User::where('user_type', 'patient')
            ->where('created_at', '>=', Carbon::now()->subYear())
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month');

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[] = $patientRegistrations[$i] ?? 0;
        }

        // Role-Specific Data
        $user = Auth::user();
        $roleData = [];

        if ($user->user_type === 'patient') {
            // Fetch patient-specific appointments
            $roleData['appointments'] = Appointment::where('patient_id', $user->id)
                ->orderBy('appointment_date', 'desc')
                ->get();
        } elseif ($user->user_type === 'doctor') {
            // Fetch appointments assigned to the doctor
            $doctor = $user->doctor; // Assumes a "doctor" relationship exists
            if ($doctor) {
                // Fetch confirmed upcoming appointments for the doctor
                $roleData['appointments'] = Appointment::where('doctor_id', $doctor->id)
                ->where('status', 'confirmed')
                ->where('appointment_date', '>=', Carbon::today())
                ->orderBy('appointment_date', 'asc')
                ->get();

                // Pending appointments for the logged-in doctor
                $roleData['pendingAppointments'] = Appointment::where('doctor_id', $doctor->id)
                ->where('status', 'pending')
                ->get();

                    //dd($roleData['appointments']);

                    $roleData['patients'] = Patient::whereHas('user', function ($query) {
                        $query->where('user_type', 'patient');
                    })->get();

                // Gender distribution for patients by month
                $genderData = Patient::selectRaw('MONTH(created_at) as month, gender, COUNT(*) as count')
                ->groupBy('month', 'gender')
                ->get()
                ->groupBy('month')
                ->map(function ($monthGroup) {
                    return $monthGroup->keyBy('gender')->map(function ($item) {
                        return $item->count;
                    });
                })
                ->toArray();

                $malePatients = array_fill(1, 12, 0);
                $femalePatients = array_fill(1, 12, 0);

                // Populate the arrays with the data from the database
                foreach ($genderData as $month => $genders) {
                    if (isset($genders['male'])) {
                        $malePatients[$month] = $genders['male'];
                    }
                    if (isset($genders['female'])) {
                        $femalePatients[$month] = $genders['female'];
                    }
                }

                // Store the monthly gender data in the roleData array
                $roleData['genderData'] = [
                    'Male' => $malePatients,
                    'Female' => $femalePatients,
                ];
            }else{
                $roleData['appointments'] = collect();
                $roleData['pendingAppointments'] = collect();
            }

            $roleData['newPatients'] = User::where('user_type', 'patient')
                ->where('created_at', '>=', Carbon::now()->subYear())
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            $roleData['topDepartments'] = Appointment::selectRaw('department, COUNT(*) as total')
                ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
                ->groupBy('department')
                ->orderByDesc('total')
                ->limit(5) // Top 5 departments
                ->pluck('total', 'department')
                ->toArray(); // Convert to plain array

            // Ensure all months are represented
            $allMonths = array_fill_keys(range(1, 12), 0);
            $roleData['newPatients'] = array_replace($allMonths, $roleData['newPatients']);

        } elseif ($user->user_type === 'admin') {
            // Fetch monthly doctor registrations
            $roleData['newDoctors'] = User::where('user_type', 'doctor')
                ->where('created_at', '>=', Carbon::now()->subYear())
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            // Fetch monthly patient registrations
            $roleData['newPatients'] = User::where('user_type', 'patient')
                ->where('created_at', '>=', Carbon::now()->subYear())
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            // Ensure all months are represented
            $allMonths = array_fill_keys(range(1, 12), 0);
            $roleData['newDoctors'] = array_replace($allMonths, $roleData['newDoctors']);
            $roleData['newPatients'] = array_replace($allMonths, $roleData['newPatients']);

            // Doctor and patient lists
            $roleData['doctors'] = User::where('user_type', 'doctor')->get();
            $roleData['patients'] = User::where('user_type', 'patient')->get();

            $roleData['topDepartments'] = Appointment::selectRaw('department, COUNT(*) as total')
                ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
                ->groupBy('department')
                ->orderByDesc('total')
                ->limit(5) // Top 5 departments
                ->pluck('total', 'department')
                ->toArray(); // Convert to plain array

            // Pending appointments
            $roleData['pendingAppointments'] = Appointment::where('status', 'pending')->get();

        }

        return view('dashboard', compact('data', 'roleData', 'user'));
    }
}
