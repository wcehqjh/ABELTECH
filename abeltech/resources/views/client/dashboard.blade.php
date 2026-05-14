@extends('layouts.app')

@section('title', 'Mon compte')

@section('content')
<section style="padding: 100px 0 60px;">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-3">
        <div style="background: rgba(18,20,27,0.8); border-radius: 20px; padding: 24px; border: 1px solid rgba(0,212,255,0.1);">
          <div class="text-center mb-4">
            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #00d4ff, #7c3aed); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
              <i class="fas fa-user fa-2x"></i>
            </div>
            <h4>{{ Auth::user()->name }}</h4>
            <p style="color: rgba(255,255,255,0.5); font-size: 13px;">{{ Auth::user()->email }}</p>
          </div>
          <form method="POST" action="{{ route('client.logout') }}">
            @csrf
            <button type="submit" style="width: 100%; background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); padding: 12px; border-radius: 12px; color: #ef4444; cursor: pointer;">
              <i class="fas fa-sign-out-alt me-2"></i> Se déconnecter
            </button>
          </form>
        </div>
      </div>
      <div class="col-lg-9">
        <div style="background: rgba(18,20,27,0.6); border-radius: 20px; padding: 28px; border: 1px solid rgba(255,255,255,0.05);">
          <h3 style="margin-bottom: 20px;">Bienvenue, {{ Auth::user()->name }} 👋</h3>
          <div class="row g-4 mb-4">
            <div class="col-md-4">
              <div style="background: rgba(0,212,255,0.05); border-radius: 16px; padding: 20px; text-align: center;">
                <i class="fas fa-shopping-cart" style="font-size: 32px; color: #00d4ff;"></i>
                <h4 style="margin: 10px 0;">{{ \App\Models\Order::where('customer_email', Auth::user()->email)->count() }}</h4>
                <p style="color: rgba(255,255,255,0.5);">Commandes</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
