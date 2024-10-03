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
        return view('admin.index', compact('admins'));
    }
    public function create()
    {
        return view('admin.create');
    }

    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }
    // Enregistrement d'un administrateur dans la BDD et envoie de mail
    public function store(storeAdminRequest $request)
    {
        try {
            // logique de la création du compte
            $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('default');
            $user->save();

            // Envoyer un email pour que l'administrateur puisse confirmer son compte
            // Envoi de code par email pour vérification
            // ...

            if ($user) {
                try {
                    ResetCodePassword::where('email', $user->email)->delete();
                    $code  = rand(1000, 4000);

                    $data = [
                        'code' => $code,
                        'email' => $user->email
                    ];

                    ResetCodePassword::create($data);
                    Notification::route('mail', $user->email)->notify(new SendEmailToAdminAfterRegistrationNotification($code, $user->email));

                    // rediriger l'administrateur vers un Url
                } catch (Exception $e) {
                    throw new ('une erreur est survenue lors de de l\'envoi du mail');
                }
            }
            //return redirect()->route('admin.login')->with('success', 'Votre compte a été créé avec succès');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement');
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
