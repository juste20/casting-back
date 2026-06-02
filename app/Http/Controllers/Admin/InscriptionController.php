<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;

class InscriptionController extends Controller
{
    /**
     * Affichage de la page des inscriptions
     */
    public function index()
    {
        // Récupère toutes les inscriptions
        // triées de la plus récente à la plus ancienne
        $subscriptions = Subscription::latest()->get();

        // Retourne la vue admin.subscriptions
        return view('admin.subscriptions', compact('subscriptions'));
    }

    /**
     * Afficher une inscription spécifique
     * (API ou debug)
     */
    public function show($id)
    {
        // Recherche l'inscription par ID
        // ou retourne une erreur 404
        $subscription = Subscription::findOrFail($id);

        // Retour JSON
        return response()->json($subscription);
    }

    /**
     * Historique des inscriptions
     *
     * Contient :
     * - les inscriptions reçues
     * - les inscriptions en attente
     * - les inscriptions envoyées
     */
    public function history()
    {
        // Récupère toutes les inscriptions
        // triées de la plus récente à la plus ancienne
        $subscriptions = Subscription::latest()->get();

        // Retourne la page historique
        return view('admin.history-subscriptions', compact('subscriptions'));
    }
}