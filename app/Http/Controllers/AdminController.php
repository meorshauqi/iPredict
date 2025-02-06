<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Show the form to create a new doctor.
     */
    public function createDoctor()
    {
        $departments = ['Dermatology', 'Allergy', 'Immunology', 'Gastroenterology', 'Hepatology', 'Endocrinology', 'Pulmonology', 'Cardiology', 'Neurology', 'Orthopedics',
                        'Neurosurgery', 'General Surgery', 'General Medicine', 'Vascular Surgery', 'Rheumatology' , 'ENT', 'Urology' , 'Infectious Diseases']; // Example departments
        return view('doctors.create', compact('departments'));
    }

    public function listDoctors()
    {
        $doctors = Doctor::with('user')->get();
        return view('doctors.list', compact('doctors'));
    }

    /**
     * Store a newly created doctor in the database.
     */
    public function storeDoctor(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'mobile' => 'required|string|max:15',
            'department' => 'required|string',
        ]);

        //dd($validatedData);

        // Create User
        $user = User::create([
            'name' => $validatedData['first_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phone' => $validatedData['mobile'],
            'user_type' => 'doctor',
        ]);

        //dd($user);

        // Create Doctor
        Doctor::create([
            'user_id' => $user->id,
            'department' => $validatedData['department'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Doctor added successfully.');
    }

    public function destroyDoctor(Doctor $doctor)
    {
        // Delete the associated user
        $user = $doctor->user;
        if ($user) {
            $user->delete(); // Cascade delete user
        }

        // Delete the doctor record
        $doctor->delete();

        return redirect()->route('doctors.list')->with('success', 'Doctor deleted successfully.');
    }

}
