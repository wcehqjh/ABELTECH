<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin') – Abeltech</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
  @stack('styles')
</head>
<body class="admin-body">

  <!-- SIDEBAR -->
  <aside class="admin-sidebar" id="sidebar">
    <div class="sidebar-logo">
      <span class="brand-abel">Abel</span><span class="brand-tech">tech</span>
      <span class="sidebar-badge">Admin</span>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-section-label">Principal</div>
      <a href="{{ route('admin.dashboard') }}"
         class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-chart-line"></i> Dashboard
      </a>
      <a href="{{ route('admin.products.index') }}"
         class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <i class="fas fa-box"></i> Produits
        <span class="sidebar-count">{{ \App\Models\Product::count() }}</span>
      </a>

      <div class="nav-section-label mt-3">Boutique</div>
      <a href="{{ route('shop.index') }}" target="_blank" class="sidebar-link">
        <i class="fas fa-store"></i> Voir la boutique
        <i class="fas fa-external-link-alt" style="font-size:.65rem;margin-left:auto"></i>
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
        <div>
          <div style="font-size:.85rem;color:#fff;font-weight:600">{{ auth()->user()->name }}</div>
          <div style="font-size:.72rem;color:#7a8599">Administrateur</div>
        </div>
      </div>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="sidebar-logout" title="Déconnexion">
          <i class="fas fa-sign-out-alt"></i>
        </button>
      </form>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="admin-main">
    <!-- TOPBAR -->
    <div class="admin-topbar">
      <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
      </button>
      <div style="color:#7a8599;font-size:.85rem">
        @yield('title', 'Dashboard')
      </div>
      <div class="d-flex align-items-center gap-3">
        @if(session('success'))
          <span style="color:#22c55e;font-size:.85rem">
            <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
          </span>
        @endif
      </div>
    </div>

    <!-- CONTENT -->
    <div class="admin-content">
      @yield('content')
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('collapsed');
    }
  </script>
  @stack('scripts')
</body>
</html>