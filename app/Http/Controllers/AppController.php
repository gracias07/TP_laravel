<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employer;
use App\Models\User;
use App\Models\Configuration;
use Illuminate\Http\Request;

class AppController extends Controller
{
    //
    public function index(){
        $totalDepartements = Departement::all()->count();
        $totalEmployers = Employer::all()->count();
        $totalAdministrateurs = User::all()->count();
//        $appName = Configuration::where('type', 'APP_NAME')->first();

       // dd($appName->value);
        return view('dashboard', compact('totalDepartements','totalEmployers','totalAdministrateurs'));
    }
}
