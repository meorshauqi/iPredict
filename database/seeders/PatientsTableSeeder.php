<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;
use App\Models\User;

class PatientsTableSeeder extends Seeder
{
    public function run()
    {
        // Assuming there's already a patient user in the users table with user_type = 'patient'
        $user = User::where('user_type', 'patient')->first();

        if ($user) {
            Patient::create([
                'user_id' => $user->id,
                'picture' => null, // Set to null initially, or add a default path if needed
                'ic' => '12345678', // Example IC number
                'address' => '123 Patient Street', // Example address
                'date_of_birth' => '2000-01-01', // Example date of birth
                'gender' => 'female', // Example gender
            ]);
        }
    }
}
