<?php

namespace App\Http\Controllers;

use App\Models\Devi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DevisController extends Controller
{
    public function send(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'service' => 'required|string',
            'budget' => 'nullable|string',
            'deadline' => 'nullable|string',
            'description' => 'required|string|min:10'
        ]);

        // Sauvegarder dans la base de données
        $devis = Devi::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'service' => $request->service,
            'budget' => $request->budget,
            'deadline' => $request->deadline,
            'description' => $request->description,
            'is_read' => false
        ]);

        // Enregistrer dans le log
        Log::info('📋 Nouvelle demande de devis #' . $devis->id, [
            'Nom' => $request->name,
            'Email' => $request->email,
            'Téléphone' => $request->phone,
            'Service' => $request->service,
            'Budget' => $request->budget ?? 'Non spécifié',
            'Délai' => $request->deadline ?? 'Non spécifié'
        ]);

        return redirect()->route('devis')
            ->with('success', '✅ Votre demande de devis a été envoyée avec succès ! Nous vous contacterons dans les plus brefs délais.');
    }
}
