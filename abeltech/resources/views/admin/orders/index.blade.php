@extends('layouts.admin')
@section('title', 'Commandes')

@section('content')
<div class="admin-header">
  <h1>Commandes</h1>
  <span style="color:#7a8599;font-size:.9rem">{{ $counts['all'] }} commande(s) au total</span>
</div>

<!-- Filtres statuts -->
<div class="order-status-tabs mb-4">
  @php
    $statuses = [
      ''           => ['label'=>'Toutes',       'count'=>$counts['all']],
      'pending'    => ['label'=>'En attente',   'count'=>$counts['pending']],
      'confirmed'  => ['label'=>'Confirmées',   'count'=>$counts['confirmed']],
      'processing' => ['label'=>'En préparation','count'=>$counts['processing']],
      'shipped'    => ['label'=>'Expédiées',    'count'=>$counts['shipped']],
      'delivered'  => ['label'=>'Livrées',      'count'=>$counts['delivered']],
      'cancelled'  => ['label'=>'Annulées',     'count'=>$counts['cancelled']],
    ];
  @endphp
  @foreach($statuses as $val => $info)
    <a href="{{ route('admin.orders.index', $val ? ['status'=>$val] : []) }}"
       class="order-tab {{ request('status',$val===''?'':null) === $val ? 'active' : '' }}">
      {{ $info['label'] }}
      <span class="order-tab-count">{{ $info['count'] }}</span>
    </a>
  @endforeach
</div>

<!-- Table commandes -->
<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th>N° Commande</th><th>Client</th><th>Articles</th>
        <th>Total</th><th>Paiement</th><th>Statut</th><th>Date</th><th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($orders as $order)
        <tr>
          <td>
            <span style="color:#00d4ff;font-weight:700;font-size:.88rem">
              {{ $order->order_number }}
            </span>
          </td>
          <td>
            <div style="font-size:.88rem;color:#fff">{{ $order->customer_name }}</div>
            <div style="font-size:.75rem;color:#7a8599">{{ $order->customer_phone }}</div>
          </td>
          <td style="color:#b0b8c8;font-size:.85rem">{{ $order->items->count() }} article(s)</td>
          <td style="color:#00d4ff;font-weight:700">
            {{ number_format($order->total, 0, ',', ' ') }} MAD
          </td>
          <td style="font-size:.8rem;color:#b0b8c8">{{ $order->payment_label }}</td>
          <td>
            <span class="status-badge"
              style="background:{{ $order->status_color }}18;color:{{ $order->status_color }};border-color:{{ $order->status_color }}40">
              {{ $order->status_label }}
            </span>
          </td>
          <td style="font-size:.8rem;color:#7a8599">
            {{ $order->created_at->format('d/m/Y H:i') }}
          </td>
          <td>
            <a href="{{ route('admin.orders.show', $order) }}" class="admin-btn-edit">
              <i class="fas fa-eye"></i>
            </a>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" style="text-align:center;padding:40px;color:#7a8599">
            Aucune commande pour le moment.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
  <div class="p-4">{{ $orders->links() }}</div>
</div>
@endsection