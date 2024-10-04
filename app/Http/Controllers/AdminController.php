<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeAdminRequest;
use App\Http\Requests\updateAdminRequest;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\SendEmailToAdminAfterRegistrationNotification;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    //
    public function index(){
        //$admins = User::where('role', 'admin')->get();
        $admins = User::paginate(10);
        return view('admins.index', compact('admins'));
    }
    public function create()
    {
        return view('admins.create');
    }

    public function edit(User $user)
    {
        return view('admins.edit', compact('user'));
    }
    // Enregistrement d'un administrateur dans la BDD et envoie de mail
    public function store(storeAdminRequest $request)
    {
        try {
            // Logique pour créer l'utilisateur
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');
            $user->save();

            if ($user) {
                try {
                    // Supprimer tout code précédent
                    ResetCodePassword::where('email', $user->email)->delete();

                    // Générer un code
                    $code  = rand(1000, 9999);

                    // Enregistrer le code de réinitialisation
                    ResetCodePassword::create([
                        'code' => $code,
                        'email' => $user->email
                    ]);

                    // Envoyer la notification par e-mail
                    Notification::route('mail', $user->email)
                        ->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email));

                    // Rediriger avec succès
                    return redirect()->route('administrateurs')->with('success_message', 'Administrateur ajouté avec succès');
                } catch (Exception $e) {
                    return redirect()->back()->with('error', 'Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
                }
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement : ' . $e->getMessage());
        }
    }


    public function update(updateAdminRequest $request, User $user)
    {
        try {
            // logique de la mise à jour du compte
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour');
        }
    }

    public function delete(User $user)
    {
        try {
            // logique de la suppression du compte
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la suppression');
        }
    }
}
