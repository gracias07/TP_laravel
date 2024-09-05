<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    //
    public function index(){
        $employers = Employer::paginate(10);
        return view('employers.index', compact('employers'));
    }

    public function create(){
        return view('employers.create');
    }

    public function edit(Employer $employers){
         return view('employers.edit', compact('employer'));
    }
}
