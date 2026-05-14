@extends('layouts.admin')
@section('title', 'Commande '.$order->order_number)

@section('content')
<div class="admin-header">
  <div>
    <h1>{{ $order->order_number }}</h1>
    <p class="text-muted mb-0">{{ $order->created_at->format('d/m/Y à H:i') }}</p>
  </div>
  <a href="{{ route('admin.orders.index') }}" class="btn-outline-glow">
    <i class="fas fa-arrow-left"></i> Retour
  </a>
</div>

<div class="row g-4">

  <!-- DÉTAILS -->
  <div class="col-lg-8">
    <!-- Articles -->
    <div class="admin-card mb-4">
      <div class="admin-card-header">
        <h5><i class="fas fa-box me-2" style="color:#00d4ff"></i>Articles commandés</h5>
      </div>
      <table class="admin-table">
        <thead><tr><th>Produit</th><th>Prix unitaire</th><th>Qté</th><th>Sous-total</th></tr></thead>
        <tbody>
          @foreach($order->items as $item)
            <tr>
              <td>
                @if($item->product)
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}"
                      style="width:44px;height:44px;object-fit:cover;border-radius:8px">
                    <a href="{{ route('shop.show', $item->product->slug) }}" target="_blank"
                      style="color:#fff;font-size:.88rem">{{ $item->product_name }}</a>
                  </div>
                @else
                  <span style="color:#7a8599;font-size:.88rem">{{ $item->product_name }} (supprimé)</span>
                @endif
              </td>
              <td style="color:#b0b8c8;font-size:.88rem">{{ number_format($item->product_price,0,',',' ') }} MAD</td>
              <td style="color:#fff">×{{ $item->quantity }}</td>
              <td style="color:#00d4ff;font-weight:700">{{ number_format($item->subtotal,0,',',' ') }} MAD</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div style="padding:16px 24px;border-top:1px solid rgba(255,255,255,.06);text-align:right">
        <div style="color:#7a8599;font-size:.85rem;margin-bottom:4px">
          Sous-total : {{ number_format($order->subtotal,0,',',' ') }} MAD
        </div>
        <div style="color:#7a8599;font-size:.85rem;margin-bottom:8px">
          Livraison : <span style="color:#22c55e">Gratuite</span>
        </div>
        <div style="font-size:1.2rem;font-weight:800;color:#00d4ff">
          Total : {{ number_format($order->total,0,',',' ') }} MAD
        </div>
      </div>
    </div>

    <!-- Infos client -->
    <div class="admin-card">
      <div class="admin-card-header">
        <h5><i class="fas fa-user me-2" style="color:#00d4ff"></i>Informations client</h5>
      </div>
      <div class="admin-card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <div class="info-block">
              <div class="info-label">Nom</div>
              <div class="info-value">{{ $order->customer_name }}</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-block">
              <div class="info-label">Email</div>
              <div class="info-value">{{ $order->customer_email }}</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-block">
              <div class="info-label">Téléphone</div>
              <div class="info-value">{{ $order->customer_phone }}</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-block">
              <div class="info-label">Adresse</div>
              <div class="info-value">{{ $order->address }}, {{ $order->city }} {{ $order->zip }}</div>
            </div>
          </div>
          @if($order->notes)
            <div class="col-12">
              <div class="info-block">
                <div class="info-label">Notes</div>
                <div class="info-value">{{ $order->notes }}</div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- SIDEBAR STATUT -->
  <div class="col-lg-4">
    <div class="admin-card mb-4">
      <div class="admin-card-header">
        <h5><i class="fas fa-tasks me-2" style="color:#00d4ff"></i>Statut commande</h5>
      </div>
      <div class="admin-card-body">
        <div class="current-status-badge mb-4" style="background:{{ $order->status_color }}18;border-color:{{ $order->status_color }}40">
          <span style="color:{{ $order->status_color }};font-weight:700;font-size:1rem">
            {{ $order->status_label }}
          </span>
        </div>

        <!-- Changer statut -->
        <form method="POST" action="{{ route('admin.orders.status', $order) }}">
          @csrf @method('PATCH')
          <label class="form-label-dark">Changer le statut</label>
          <select name="status" class="input-dark mb-3">
            @foreach(['pending'=>'En attente','confirmed'=>'Confirmée','processing'=>'En préparation',
                      'shipped'=>'Expédiée','delivered'=>'Livrée','cancelled'=>'Annulée'] as $val=>$lbl)
              <option value="{{ $val }}" {{ $order->status===$val?'selected':'' }}>{{ $lbl }}</option>
            @endforeach
          </select>
          <button type="submit" class="btn-glow w-100">
            <i class="fas fa-save me-2"></i> Mettre à jour
          </button>
        </form>
      </div>
    </div>

    <!-- Paiement -->
    <div class="admin-card">
      <div class="admin-card-header">
        <h5><i class="fas fa-credit-card me-2" style="color:#00d4ff"></i>Paiement</h5>
      </div>
      <div class="admin-card-body">
        <div class="info-block">
          <div class="info-label">Mode</div>
          <div class="info-value">{{ $order->payment_label }}</div>
        </div>
        <div class="info-block mt-3">
          <div class="info-label">Statut paiement</div>
          <div class="info-value">
            @if($order->payment_status === 'paid')
              <span style="color:#22c55e"><i class="fas fa-check-circle me-1"></i>Payé</span>
            @elseif($order->payment_status === 'refunded')
              <span style="color:#ff5757"><i class="fas fa-undo me-1"></i>Remboursé</span>
            @else
              <span style="color:#fbbf24"><i class="fas fa-clock me-1"></i>En attente</span>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<style>
.info-block { margin-bottom:4px; }
.info-label { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; color:#7a8599; margin-bottom:2px; }
.info-value { color:#fff; font-size:.9rem; }
.status-badge { padding:5px 12px; border-radius:20px; font-size:.75rem; font-weight:700; border:1px solid; }
.order-status-tabs { display:flex; flex-wrap:wrap; gap:8px; }
.order-tab { padding:8px 16px; border-radius:8px; font-size:.82rem; color:#7a8599; text-decoration:none; background:#111318; border:1.5px solid rgba(255,255,255,.06); transition:all .2s; display:flex; align-items:center; gap:6px; }
.order-tab:hover { color:#fff; border-color:rgba(255,255,255,.15); }
.order-tab.active { color:#00d4ff; border-color:rgba(0,212,255,.3); background:rgba(0,212,255,.06); }
.order-tab-count { background:rgba(255,255,255,.08); padding:1px 7px; border-radius:10px; font-size:.72rem; }
.current-status-badge { padding:14px; border-radius:12px; border:1.5px solid; text-align:center; }
</style>
@endsection