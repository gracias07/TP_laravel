<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importation de la façade Auth

class AuthController extends Controller
{
    // Afficher la vue de connexion
    public function login()
    {
        return view('auth.login');
    }

    // Gérer la soumission du formulaire de connexion
    public function handleLogin(AuthRequest $request)
{
    // Récupérer les informations d'identification (email et mot de passe)
    $credentials = $request->only(['email', 'password']);

    // Tentative de connexion avec les informations fournies
    if (Auth::attempt($credentials)) {
        // Rediriger vers le tableau de bord en cas de succès
        return redirect()->route('dashboard');
    } else {
        // Rediriger en arrière avec un message d'erreur en cas d'échec
        return redirect()->back()->with('error_msg', 'Paramètres de connexion non reconnus');
    }
}

}
