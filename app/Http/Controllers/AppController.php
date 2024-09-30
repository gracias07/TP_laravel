<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employer;
use App\Models\User;
use App\Models\Configuration;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        // Récupération des totaux
        $totalDepartements = Departement::count();
        $totalEmployers = Employer::count();
        $totalAdministrateurs = User::count();
        // $appName = Configuration::where('type', 'APP_NAME')->first(); // Ligne commentée

        // Initialisation des variables de notification de paiement
        $paymentNotification = null;
        $currentDate = Carbon::now()->day();

        // Récupération de la date de paiement par défaut depuis la configuration
        $defaultPaymentDateQuery = Configuration::where('type', 'PAYMENT_DATE')->first();

        if ($defaultPaymentDateQuery) {
            // Vérifiez si la valeur est une date valide
            $defaultPaymentDate = $defaultPaymentDateQuery->value;

            // Essayez de la convertir en date uniquement si elle est valide
            if (strtotime($defaultPaymentDate)) {
                $defaultPaymentDate = Carbon::parse($defaultPaymentDate)->day;

                if ($currentDate < $defaultPaymentDate) {
                    $paymentNotification = "Le paiement doit avoir lieu le " . $defaultPaymentDate . " de ce mois.";
                } else {
                    $nextMonth = Carbon::now()->addMonth();
                    $nextMonthName = $nextMonth->translatedFormat('F'); // Mois en français
                    $paymentNotification = "Le paiement doit avoir lieu le " . $defaultPaymentDate . " du mois de " . $nextMonthName . ".";
                }

            } else {
                // Gérer le cas où la date n'est pas valide
                $paymentNotification = "Erreur : la date de paiement configurée est invalide.";
            }
        }



        // Retour de la vue avec les variables compactées
        return view('dashboard', compact(
            'totalDepartements',
            'totalEmployers',
            'totalAdministrateurs',
            'paymentNotification'
        ));
    }
}
