<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class HomeController extends Controller
{
    public function index()
    {
        $totalPatients = Appointment::count();

        return view('frontend.index', compact('totalPatients'));
    }
}