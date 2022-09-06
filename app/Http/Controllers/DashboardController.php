<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordini;
use App\Events\NuovoOrdine;

class DashboardController extends Controller
{
    public function addOrder(Request $request)
    {
        $request->validate([
            'ordine' => ['required', 'int'],
        ]);

        try {
            $ordine = Ordini::create([
                'numero' => $request->ordine,
            ]);

            event(new NuovoOrdine($ordine));  // creo l'evento broadcast dell'ordine appena inserito

        } catch(\Exception $e) {
            return redirect()->back()->with('errore', 'C\'è stato un problema. Ordine non pubblicato.');
        }
 
        return redirect()->back()->with('successo', 'Numero d\'ordine pubblicato');

    }
}
