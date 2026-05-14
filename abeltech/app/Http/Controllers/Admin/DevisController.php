<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Devi;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    public function index()
    {
        $devis = Devi::latest()->paginate(20);
        $unreadCount = Devi::where('is_read', false)->count();
        
        return view('admin.devis.index', compact('devis', 'unreadCount'));
    }

    public function show($id)
    {
        $devis = Devi::findOrFail($id);
        
        if (!$devis->is_read) {
            $devis->is_read = true;
            $devis->save();
        }
        
        return view('admin.devis.show', compact('devis'));
    }

    public function destroy($id)
    {
        $devis = Devi::findOrFail($id);
        $devis->delete();
        
        return redirect()->route('admin.devis.index')
            ->with('success', 'Demande de devis supprimée avec succès');
    }
}
