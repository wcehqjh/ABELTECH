<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'message' => 'required|string|min:10'
        ]);

        // حفظ الرسالة في قاعدة البيانات
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'is_read' => false
        ]);

        // تسجيل في اللوج
        Log::info('📧 Nouveau message de contact - Abeltech', [
            'Nom' => $request->name,
            'Email' => $request->email,
            'Téléphone' => $request->phone,
            'Message' => $request->message
        ]);

        return redirect()->route('contact')
            ->with('success', '✅ Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }
}
