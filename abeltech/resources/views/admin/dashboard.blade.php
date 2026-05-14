@extends('layouts.admin')

@section('title', 'Dashboard')
@section('content')

{{-- Statistiques --}}
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-box"></i></div>
    <div class="stat-value">{{ \App\Models\Product::count() }}</div>
    <div class="stat-label">Produits</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
    <div class="stat-value">{{ \App\Models\Order::count() }}</div>
    <div class="stat-label">Commandes</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-users"></i></div>
    <div class="stat-value">{{ \App\Models\User::count() }}</div>
    <div class="stat-label">Clients</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
    <div class="stat-value">{{ number_format(\App\Models\Order::sum('total'), 0, ',', ' ') }} MAD</div>
    <div class="stat-label">Chiffre d'affaires</div>
  </div>
</div>

{{-- Dernières commandes --}}
<div class="admin-table-container">
  <div class="admin-table-header">
    <h3 class="admin-table-title">📦 Dernières commandes</h3>
    <a href="{{ route('admin.orders.index') }}" class="btn-primary" style="padding: 6px 12px; font-size: 12px;">Voir toutes</a>
  </div>
  <table class="admin-table">
    <thead>
      <tr>
        <th>N° commande</th>
        <th>Client</th>
        <th>Total</th>
        <th>Statut</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @forelse(\App\Models\Order::latest()->take(5)->get() as $order)
      <tr>
        <td>{{ $order->order_number ?? 'N/A' }}</td>
        <td>{{ $order->customer_name ?? 'N/A' }}</td>
        <td>{{ number_format($order->total ?? 0, 0, ',', ' ') }} MAD</td>
        <td>
          <span class="status-badge status-{{ $order->status ?? 'pending' }}">
            {{ $order->status ?? 'pending' }}
          </span>
        </td>
        <td>{{ optional($order->created_at)->format('d/m/Y') ?? 'N/A' }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="5" style="text-align: center;">Aucune commande pour le moment</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- Section principale: Messages et Devis --}}
<div class="row mt-4">
  
  {{-- Colonne 1: Messages de contact --}}
  <div class="col-lg-6">
    <div class="admin-table-container">
      <div class="admin-table-header">
        <h3 class="admin-table-title">
          <i class="fas fa-envelope" style="color: #00d4ff;"></i> Messages de contact
          @php $unreadContacts = \App\Models\Contact::where('is_read', false)->count(); @endphp
          @if($unreadContacts > 0)
            <span class="badge-unread" style="background:#ef4444; color:white; padding:4px 12px; border-radius:20px; margin-left:10px;">
              {{ $unreadContacts }} non lu(s)
            </span>
          @endif
        </h3>
        <a href="{{ route('admin.messages.index') }}" class="btn-primary" style="padding: 6px 12px; font-size: 12px;">
          <i class="fas fa-list"></i> Tous les messages
        </a>
      </div>
      
      @forelse(\App\Models\Contact::latest()->take(5)->get() as $message)
        <div class="message-item">
          <div class="message-avatar">
            <i class="fas fa-user-circle"></i>
          </div>
          <div class="message-content">
            <div class="message-header">
              <strong class="message-name">{{ $message->name }}</strong>
              <span class="message-date">{{ $message->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="message-email">
              <i class="fas fa-envelope"></i> {{ $message->email }}
            </div>
            <div class="message-text">
              {{ \Illuminate\Support\Str::limit($message->message, 80) }}
            </div>
            <div class="message-footer">
              @if(!$message->is_read)
                <span class="status-badge status-pending">📩 Non lu</span>
              @else
                <span class="status-badge status-completed">✓ Lu</span>
              @endif
              <a href="{{ route('admin.messages.show', $message->id) }}" class="btn-message-view">
                <i class="fas fa-eye"></i> Lire
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="empty-message">
          <i class="fas fa-inbox"></i>
          <p>Aucun message de contact</p>
        </div>
      @endforelse
    </div>
  </div>

  {{-- Colonne 2: Demandes de devis --}}
  <div class="col-lg-6">
    <div class="admin-table-container">
      <div class="admin-table-header">
        <h3 class="admin-table-title">
          <i class="fas fa-file-invoice" style="color: #00d4ff;"></i> Demandes de devis
          @php $unreadDevis = \App\Models\Devi::where('is_read', false)->count(); @endphp
          @if($unreadDevis > 0)
            <span class="badge-unread" style="background:#ef4444; color:white; padding:4px 12px; border-radius:20px; margin-left:10px;">
              {{ $unreadDevis }} non lue(s)
            </span>
          @endif
        </h3>
        <a href="{{ route('admin.devis.index') }}" class="btn-primary" style="padding: 6px 12px; font-size: 12px;">
          <i class="fas fa-list"></i> Toutes les demandes
        </a>
      </div>
      
      @forelse(\App\Models\Devi::latest()->take(5)->get() as $devis)
        <div class="message-item">
          <div class="message-avatar" style="background: rgba(0,212,255,0.1);">
            <i class="fas fa-file-invoice" style="color: #00d4ff;"></i>
          </div>
          <div class="message-content">
            <div class="message-header">
              <strong class="message-name">{{ $devis->name }}</strong>
              <span class="message-date">{{ $devis->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="message-email">
              <i class="fas fa-envelope"></i> {{ $devis->email }}
            </div>
            <div class="message-text">
              <strong>Service demandé:</strong> {{ $devis->service }}
            </div>
            <div class="message-footer">
              @if(!$devis->is_read)
                <span class="status-badge status-pending">📩 Non lue</span>
              @else
                <span class="status-badge status-completed">✓ Lue</span>
              @endif
              <a href="{{ route('admin.devis.show', $devis->id) }}" class="btn-message-view">
                <i class="fas fa-eye"></i> Détails
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="empty-message">
          <i class="fas fa-inbox"></i>
          <p>Aucune demande de devis</p>
        </div>
      @endforelse
    </div>
  </div>
</div>

<style>
/* Styles pour les messages */
.message-item {
  display: flex;
  gap: 15px;
  padding: 18px;
  border-bottom: 1px solid rgba(255,255,255,0.05);
  transition: background 0.3s;
}

.message-item:hover {
  background: rgba(0,212,255,0.03);
}

.message-avatar {
  width: 50px;
  height: 50px;
  background: rgba(255,255,255,0.05);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  color: rgba(255,255,255,0.6);
  flex-shrink: 0;
}

.message-content {
  flex: 1;
}

.message-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  margin-bottom: 5px;
}

.message-name {
  font-size: 15px;
  font-weight: 700;
  color: #fff;
}

.message-date {
  font-size: 11px;
  color: rgba(255,255,255,0.4);
}

.message-email {
  font-size: 12px;
  color: #00d4ff;
  margin-bottom: 8px;
}

.message-text {
  font-size: 13px;
  color: rgba(255,255,255,0.6);
  line-height: 1.4;
  margin-bottom: 10px;
}

.message-footer {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 8px;
}

.btn-message-view {
  background: rgba(0,212,255,0.1);
  border: none;
  padding: 5px 12px;
  border-radius: 20px;
  color: #00d4ff;
  font-size: 11px;
  text-decoration: none;
  transition: all 0.2s;
}

.btn-message-view:hover {
  background: #00d4ff;
  color: #000;
}

.empty-message {
  text-align: center;
  padding: 40px;
  color: rgba(255,255,255,0.3);
}

.empty-message i {
  font-size: 48px;
  margin-bottom: 15px;
  display: block;
}

.empty-message p {
  margin: 0;
}

.mt-4 {
  margin-top: 24px;
}

.admin-table-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  padding: 16px 20px;
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
</style>
@endsection