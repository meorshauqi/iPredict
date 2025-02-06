<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;

class PatientController extends Controller
{
    /**
     * Display a list of patients based on user type.
     */
    public function index()
    {
        $user = Auth::user();

        if (in_array($user->user_type, ['admin', 'doctor'])) {
            // Fetch all users with user_type 'patient' and their appointments
            $users = User::with('appointments', 'patient') // Include patient-specific details
                ->where('user_type', 'patient')
                ->get();
        } else {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to view this page.');
        }

        // Return the patient view with the list of users (patients)
        return view('patient', compact('users'));
    }


    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        // Delete the related user record
        $patient->user()->delete();

        // Delete the patient record
        $patient->delete();

        return redirect()->route('patient.list')->with('success', 'Patient deleted successfully.');
    }

}
