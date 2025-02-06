<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptoms;

class SymptomController extends Controller
{
    /**
     * Display the Symptom Checker page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all symptoms from the database
        $symptoms = Symptoms::all();

        return view('symptom.checker', compact('symptoms')); // Assuming 'checker.blade.php' is located in the 'resources/views/patient/' directory
    }
}
