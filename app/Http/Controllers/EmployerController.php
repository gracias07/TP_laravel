<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\Departement;
use App\Models\Employer;
use Exception;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    //
    public function index()
    {
        $employers = Employer::with('departement')->paginate(10);
        return view('employers.index', compact('employers'));
    }

    public function create()
    {
        $departements = Departement::all();
        return view('employers.create', compact('departements'));
    }

    public function edit(Employer $employer)
    {
        $departements = Departement::all();
        return view('employers.edit', compact('employer', 'departements'));
    }

    public function store(StoreEmployeRequest $request)
    {
        // Validation est déjà gérée par StoreEmployeRequest
        // Crée un nouvel employé avec les données validées
        Employer::create($request->validated());

        // Redirige vers la liste des employeurs avec un message de succès
        return redirect()->route('employers.index')->with('success_message', 'Employé ajouté avec succès.');
    }
    public function update(UpdateEmployerRequest $request, Employer $employer)
    {
        try {
            // Mettre à jour les informations de l'employé
            $employer->nom = $request->nom;
            $employer->prenom = $request->prenom;
            $employer->email = $request->email;
            $employer->contact = $request->contact;
            $employer->departement_id = $request->departement_id;
            $employer->montant_journalier = $request->montant_journalier; // Correction ici

            $employer->save(); // Utilise save() plutôt que update() pour sauvegarder les changements

            // Redirection avec message de succès
            return redirect()->route('employers.index')->with('success_message', 'Les informations de l\'employé ont été modifiées avec succès');
        } catch (\Exception $e) {
            // Redirection en cas d'erreur
            return redirect()->back()->with('error_message', 'Erreur lors de la modification de l\'employé');
        }
    }
    public function delete($id)
    {
        try {
            $employer = Employer::findOrFail($id);
            $employer->delete();

            return redirect()->route('employers.index')->with('success_message', 'Suppression éffectuée');
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'Erreur lors de la suppression de l\'employé.');
        }
    }
}
