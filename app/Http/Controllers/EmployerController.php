<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Models\Departement;
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
        $departements = Departement::all();
        return view('employers.create', compact('departements'));
    }

    public function edit(Employer $employers){
         return view('employers.edit', compact('employer'));
    }

    public function store(StoreEmployeRequest $request)
    {
        // Validation est déjà gérée par StoreEmployeRequest
        // Crée un nouvel employé avec les données validées
        Employer::create($request->validated());

        // Redirige vers la liste des employeurs avec un message de succès
        return redirect()->route('employers.index')->with('success', 'Employé ajouté avec succès.');
    }

}
