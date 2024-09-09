<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDepartementRequest;
use App\Models\Departement;
use Illuminate\Http\Request;
use Exception;

class DepartementController extends Controller
{
    public function index()
    {
        $departements = Departement::paginate(10);
        return view('departements.index', compact('departements'));
    }

    public function create()
    {
        return view('departements.create');
    }

    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    // Interaction avec la BDD
    public function store(saveDepartementRequest $request)
    {
        // Enregistrer un nouveau département
        try {
            $departement = new Departement();
            $departement->name = $request->name;
            $departement->save();

            return redirect()->route('departements.index')->with('success_message', 'Département enregistré');
        } catch (Exception $e) {
            // Vous pouvez gérer l'erreur de manière plus propre ici
            return redirect()->route('departements.create')->withErrors('Erreur lors de l\'enregistrement du département');
        }
    }
}
