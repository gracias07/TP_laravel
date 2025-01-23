<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use App\Notifications\AdminRegisteredNotification;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    /**
     * Affiche la liste des administrateurs.
     */
    public function index()
    {
        $admins = User::where('role', 'admin')->paginate(10);
        return view('admins.index', compact('admins'));
    }

    /**
     * Affiche le formulaire de création d'un administrateur.
     */
    public function create()
    {
        return view('admins.create');
    }

    /**
     * Affiche le formulaire d'édition pour un administrateur spécifique.
     */
    public function edit(User $user)
    {
        return view('admins.edit', compact('user'));
    }

    /**
     * Enregistre un nouvel administrateur dans la base de données
     * et envoie des notifications par e-mail.
     */
    public function store(StoreAdminRequest $request)
    {
        try {
            // Création de l'utilisateur
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('default'),
            ]);

            // Envoi de la notification de confirmation à l'administrateur
            $user->notify(new AdminRegisteredNotification($user));

            return redirect()->route('administrateurs')
                ->with('success_message', 'Administrateur ajouté avec succès');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de l\'enregistrement ou de l\'envoi de l\'e-mail : ' . $e->getMessage());
        }
    }

    /**
     * Met à jour les informations d'un administrateur existant.
     */
    public function update(UpdateAdminRequest $request, User $user)
    {
        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                // Ajoutez d'autres champs si nécessaire
            ]);

            return redirect()->route('administrateurs')
                ->with('success_message', 'Administrateur mis à jour avec succès');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Supprime un administrateur existant.
     */
    public function delete(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('administrateurs')
                ->with('success_message', 'Administrateur supprimé avec succès');
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}
