<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->paginate(20);
        $unreadCount = Contact::where('is_read', false)->count();
        
        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function show($id)
    {
        $message = Contact::findOrFail($id);
        
        if (!$message->is_read) {
            $message->is_read = true;
            $message->save();
        }
        
        return view('admin.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();
        
        return redirect()->route('admin.messages.index')
            ->with('success', 'Message supprimé avec succès');
    }
}
