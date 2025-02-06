<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Doctor;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $doctors = [
            // Dermatology
            ['Dr. Farah Ismail', 'Dermatology'],
            ['Dr. Sarah Farah', 'Dermatology'],
            ['Dr. Johan Razak', 'Dermatology'],

            // Allergy
            ['Dr. Nadia Hassan', 'Allergy'],
            ['Dr. Amir Faisal', 'Allergy'],
            ['Dr. Aina Tan', 'Allergy'],

            // Immunology
            ['Dr. Daniel Chia', 'Immunology'],
            ['Dr. Maya Zain', 'Immunology'],
            ['Dr. Hafiz Ahmad', 'Immunology'],

            // Gastroenterology
            ['Dr. Arif Mahmud', 'Gastroenterology'],
            ['Dr. Olivia Wong', 'Gastroenterology'],
            ['Dr. Sophia Lim', 'Gastroenterology'],

            // Hepatology
            ['Dr. Maria Wong', 'Hepatology'],
            ['Dr. David Chan', 'Hepatology'],
            ['Dr. Zulkifli Noor', 'Hepatology'],

            // Endocrinology
            ['Dr. Emma Lim', 'Endocrinology'],
            ['Dr. Azhar Salleh', 'Endocrinology'],
            ['Dr. Rahimah Yunus', 'Endocrinology'],

            // Pulmonology
            ['Dr. Johan Syed', 'Pulmonology'],
            ['Dr. Sarah Wong', 'Pulmonology'],
            ['Dr. Aida Khalid', 'Pulmonology'],

            // Cardiology
            ['Dr. Olivia Ng', 'Cardiology'],
            ['Dr. Adam Iskandar', 'Cardiology'],
            ['Dr. Hidayah Kamal', 'Cardiology'],

            // Neurology
            ['Dr. Daniel Wong', 'Neurology'],
            ['Dr. Yasmin Ariffin', 'Neurology'],
            ['Dr. Henry Teo', 'Neurology'],

            // Orthopedics
            ['Dr. Samuel Lim', 'Orthopedics'],
            ['Dr. Shahir Omar', 'Orthopedics'],
            ['Dr. Hanisah Jamil', 'Orthopedics'],

            // Neurosurgery
            ['Dr. Michael Lee', 'Neurosurgery'],
            ['Dr. Hana Syuhada', 'Neurosurgery'],
            ['Dr. Faizal Osman', 'Neurosurgery'],

            // General Surgery
            ['Dr. Maria Teo', 'General Surgery'],
            ['Dr. Azman Ali', 'General Surgery'],
            ['Dr. Nurul Aisyah', 'General Surgery'],

            // General Medicine
            ['Dr. Emily Wong', 'General Medicine'],
            ['Dr. Hakim Bakar', 'General Medicine'],
            ['Dr. Sharifah Nadia', 'General Medicine'],

            // Vascular Surgery
            ['Dr. Grace Chia', 'Vascular Surgery'],
            ['Dr. Ahmad Shukri', 'Vascular Surgery'],
            ['Dr. Ainul Liyana', 'Vascular Surgery'],

            // Rheumatology
            ['Dr. Sarah Tan', 'Rheumatology'],
            ['Dr. Ismail Zakaria', 'Rheumatology'],
            ['Dr. Haslinda Zainal', 'Rheumatology'],

            // ENT
            ['Dr. Samuel Teo', 'ENT'],
            ['Dr. Syafiq Hashim', 'ENT'],
            ['Dr. Nur Aina', 'ENT'],

            // Urology
            ['Dr. Adam Zaid', 'Urology'],
            ['Dr. Sophia Tan', 'Urology'],
            ['Dr. Izzah Sulaiman', 'Urology'],

            // Infectious Diseases
            ['Dr. Daniel Lim', 'Infectious Diseases'],
            ['Dr. Zainab Rahman', 'Infectious Diseases'],
            ['Dr. Hafizah Ibrahim', 'Infectious Diseases'],
        ];

        foreach ($doctors as [$name, $department]) {
            // Generate a random phone number prefix between 011 and 019
            $phonePrefix = '01' . rand(1, 9);
            $phoneNumber = $phonePrefix . rand(1000000, 9999999);

            // Generate a password from the doctor's name
            $cleanPassword = strtolower(str_replace(['Dr. ', ' '], '', $name));

            $doctorUser = User::create([
                'name' => $name,
                'email' => strtolower(str_replace(['Dr. ', ' '], '', $name)) . "@hospital.com",
                'password' => Hash::make($cleanPassword),
                'phone' => $phoneNumber,
                'user_type' => 'doctor',
            ]);

            Doctor::create([
                'user_id' => $doctorUser->id,
                'department' => $department,
            ]);
        }
    }
}
