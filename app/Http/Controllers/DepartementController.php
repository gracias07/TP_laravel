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

    public function update(saveDepartementRequest $request, $id)
    {
        // Mise à jour d'un département existant
        try {
            // Récupérer le département existant
            $departement = Departement::findOrFail($id);
            $departement->name = $request->name;
            $departement->update(); // Utiliser save() pour appliquer les modifications

            return redirect()->route('departements.index')->with('success_message', 'Département mis à jour');
        } catch (Exception $e) {
            // Gérer l'erreur de manière plus propre ici
            return redirect()->route('departements.edit', $id)->withErrors('Erreur lors de la mise à jour du département');
        }

        /* Ajout du paramètre $id pour indiquer quel département mettre à jour.
           Utilisation de findOrFail($id) pour récupérer le département de la base de données.
           Utilisation de save() au lieu de update() pour enregistrer les modifications.*/
    }

    public function delete(Departement $departement)
    {
        try {
            $departement->delete();
            return redirect()->route('departements.index')->with('success_message', 'Département supprimé');
        } catch (Exception $e) {
            return redirect()->route('departements.index')->withErrors('Erreur lors de la suppression du département');
        }
    }
}
