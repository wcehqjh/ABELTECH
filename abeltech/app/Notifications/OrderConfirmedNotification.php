<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderConfirmedNotification extends Notification
{
    public function __construct(public Order $order) {}

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("✅ Commande {$this->order->order_number} confirmée – Abeltech")
            ->greeting("Bonjour {$this->order->customer_name} !")
            ->line("Votre commande **{$this->order->order_number}** a bien été reçue.")
            ->line("**Montant total : " . number_format($this->order->total, 0, ',', ' ') . " MAD**")
            ->line("**Mode de paiement :** {$this->order->payment_label}")
            ->line("**Adresse de livraison :** {$this->order->address}, {$this->order->city}")
            ->action('Voir ma commande', url('/'))
            ->line("Merci pour votre confiance. Notre équipe vous contactera sous 24h.")
            ->salutation("L'équipe Abeltech 🚀");
    }
}