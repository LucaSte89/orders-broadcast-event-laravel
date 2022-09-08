<?php

namespace App\Http\Controllers;

use App\Events\OrdineAnnullato;
use App\Events\OrdineConsegnato;
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
                'stato' => 'IN_ATTESA'
            ]);

            event(new NuovoOrdine($ordine->numero));  // creo l'evento broadcast dell'ordine appena inserito

        } catch(\Exception $e) {
            return redirect()->back()->with('errore', 'C\'è stato un problema. Ordine non pubblicato');
        }

        return redirect()->back()->with('successo', 'Numero d\'ordine pubblicato');

    }


    public function deliveredOrder(Request $request)
    {
        $request->validate([
            'ordine' => ['required'],
        ]);

        try {
            $ordineId = decrypt($request->ordine);
            $ordine = Ordini::select('numero', 'stato')->findOrFail($ordineId);

            if($ordine->stato == "IN_ATTESA") {
                Ordini::findOrFail($ordineId)->update([
                    'stato' => 'CONSEGNATO'
                ]);
            }

            event(new OrdineConsegnato($ordine->numero));

        } catch(\Exception $e) {
            return redirect()->back()->with('errore', 'Non è stato possibile aggiornare lo stato dell\'ordine');
        }

        return redirect()->back()->with('successo', 'Numero d\'ordine consegnato');

    }


    public function removeOrder(Request $request)
    {
        $request->validate([
            'ordine' => ['required'],
        ]);

        try {
            $ordineId = decrypt($request->ordine);
            $ordine = Ordini::select('numero', 'stato')->findOrFail($ordineId);

            if($ordine->stato == "IN_ATTESA") {
                Ordini::findOrFail($ordineId)->update([
                    'stato' => 'ANNULLATO'
                ]);
            }

            event(new OrdineAnnullato($ordine->numero));

        } catch(\Exception $e) {
            return redirect()->back()->with('errore', 'Non è stato possibile aggiornare lo stato dell\'ordine');
        }

        return redirect()->back()->with('successo', 'Numero d\'ordine annullato');

    }
}
