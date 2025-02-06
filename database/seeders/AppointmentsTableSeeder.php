<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('appointments')->insert([
            [
                'patient_id' => 4, // Replace with actual patient user ID
                'doctor_id' => 1, // Replace with actual doctor user ID
                'appointment_date' => Carbon::today()->addDays(1),
                'time_slot' => '10:00 AM - 10:30 AM',
                'status' => 'pending',
                'notes' => 'Initial consultation for general checkup',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
