<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin') – Abeltech</title>
  
  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- Styles personnalisés -->
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body.admin-body {
      font-family: 'Inter', sans-serif;
      background: #0a0c10;
      overflow-x: hidden;
    }

    /* ========== SIDEBAR ========== */
    .admin-sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 280px;
      height: 100vh;
      background: linear-gradient(180deg, #0f1117 0%, #0a0c10 100%);
      border-right: 1px solid rgba(255,255,255,0.05);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      display: flex;
      flex-direction: column;
    }

    .admin-sidebar.collapsed {
      width: 80px;
    }

    .admin-sidebar.collapsed .sidebar-logo .brand-abel,
    .admin-sidebar.collapsed .sidebar-logo .brand-tech,
    .admin-sidebar.collapsed .sidebar-badge,
    .admin-sidebar.collapsed .sidebar-link span:not(.sidebar-count),
    .admin-sidebar.collapsed .nav-section-label,
    .admin-sidebar.collapsed .sidebar-user > div:last-child {
      display: none;
    }

    .admin-sidebar.collapsed .sidebar-link i {
      margin-right: 0;
    }

    .admin-sidebar.collapsed .sidebar-link {
      justify-content: center;
      padding: 12px;
    }

    .admin-sidebar.collapsed .sidebar-user {
      justify-content: center;
    }

    .sidebar-logo {
      padding: 24px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.05);
      font-size: 22px;
      font-weight: 800;
      letter-spacing: 1px;
    }

    .brand-abel {
      background: linear-gradient(135deg, #fff 0%, #00d4ff 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .brand-tech {
      color: #00d4ff;
    }

    .sidebar-badge {
      display: inline-block;
      background: rgba(0,212,255,0.15);
      color: #00d4ff;
      font-size: 10px;
      padding: 2px 8px;
      border-radius: 20px;
      margin-left: 8px;
      vertical-align: middle;
    }

    .sidebar-nav {
      flex: 1;
      padding: 20px 16px;
      overflow-y: auto;
    }

    .nav-section-label {
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: rgba(255,255,255,0.3);
      margin: 20px 0 10px 12px;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 16px;
      margin: 4px 0;
      border-radius: 12px;
      color: rgba(255,255,255,0.6);
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .sidebar-link i {
      width: 20px;
      font-size: 16px;
    }

    .sidebar-link:hover {
      background: rgba(0,212,255,0.08);
      color: #00d4ff;
    }

    .sidebar-link.active {
      background: linear-gradient(90deg, rgba(0,212,255,0.15), transparent);
      color: #00d4ff;
      border-left: 3px solid #00d4ff;
    }

    .sidebar-count {
      margin-left: auto;
      background: rgba(255,255,255,0.08);
      padding: 2px 8px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
    }

    .sidebar-footer {
      padding: 20px;
      border-top: 1px solid rgba(255,255,255,0.05);
    }

    .sidebar-user {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #00d4ff, #7c3aed);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 16px;
      color: #fff;
    }

    .sidebar-logout {
      width: 100%;
      background: rgba(239,68,68,0.15);
      border: 1px solid rgba(239,68,68,0.3);
      padding: 10px;
      border-radius: 12px;
      color: #ef4444;
      cursor: pointer;
      transition: all 0.2s;
      font-size: 14px;
    }

    .sidebar-logout:hover {
      background: #ef4444;
      color: #fff;
    }

    /* ========== MAIN CONTENT ========== */
    .admin-main {
      margin-left: 280px;
      transition: all 0.3s ease;
      min-height: 100vh;
    }

    .admin-sidebar.collapsed ~ .admin-main {
      margin-left: 80px;
    }

    .admin-topbar {
      background: rgba(15,17,23,0.95);
      backdrop-filter: blur(12px);
      border-bottom: 1px solid rgba(255,255,255,0.05);
      padding: 16px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 99;
    }

    .sidebar-toggle {
      background: rgba(255,255,255,0.05);
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 10px;
      color: #fff;
      cursor: pointer;
      transition: all 0.2s;
    }

    .sidebar-toggle:hover {
      background: rgba(0,212,255,0.2);
      color: #00d4ff;
    }

    .admin-content {
      padding: 24px;
    }

    /* ========== STATS CARDS ========== */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    .stat-card {
      background: rgba(18,20,27,0.8);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255,255,255,0.05);
      border-radius: 20px;
      padding: 20px;
      transition: all 0.3s;
    }

    .stat-card:hover {
      transform: translateY(-3px);
      border-color: rgba(0,212,255,0.3);
    }

    .stat-icon {
      width: 48px;
      height: 48px;
      background: rgba(0,212,255,0.1);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      color: #00d4ff;
      margin-bottom: 16px;
    }

    .stat-value {
      font-size: 32px;
      font-weight: 800;
      color: #fff;
      margin-bottom: 4px;
    }

    .stat-label {
      font-size: 13px;
      color: rgba(255,255,255,0.5);
    }

    /* ========== TABLES ========== */
    .admin-table-container {
      background: rgba(18,20,27,0.8);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(255,255,255,0.05);
      border-radius: 20px;
      overflow: hidden;
    }

    .admin-table-header {
      padding: 16px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
    }

    .admin-table-title {
      font-size: 16px;
      font-weight: 700;
      color: #fff;
      margin: 0;
    }

    .admin-table {
      width: 100%;
      border-collapse: collapse;
    }

    .admin-table th,
    .admin-table td {
      padding: 14px 16px;
      text-align: left;
      border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .admin-table th {
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      color: rgba(255,255,255,0.5);
      background: rgba(0,0,0,0.2);
    }

    .admin-table tr:hover {
      background: rgba(0,212,255,0.03);
    }

    /* ========== STATUS BADGES ========== */
    .status-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 4px 12px;
      border-radius: 30px;
      font-size: 11px;
      font-weight: 600;
    }
    .status-pending { background: rgba(251,191,36,0.15); color: #fbbf24; }
    .status-processing { background: rgba(0,212,255,0.15); color: #00d4ff; }
    .status-completed { background: rgba(34,197,94,0.15); color: #22c55e; }
    .status-cancelled { background: rgba(239,68,68,0.15); color: #ef4444; }

    /* ========== BUTTONS ========== */
    .btn-primary {
      background: linear-gradient(135deg, #00d4ff, #7c3aed);
      border: none;
      padding: 10px 20px;
      border-radius: 12px;
      color: #fff;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.2s;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,212,255,0.3);
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
      .admin-sidebar {
        transform: translateX(-100%);
      }
      .admin-sidebar.open {
        transform: translateX(0);
      }
      .admin-main {
        margin-left: 0;
      }
      .stats-grid {
        grid-template-columns: 1fr;
      }
      .admin-table-container {
        overflow-x: auto;
      }
      .admin-table {
        min-width: 600px;
      }
    }
  </style>
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
        <i class="fas fa-chart-line"></i> <span>Dashboard</span>
      </a>
      <a href="{{ route('admin.products.index') }}"
         class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <i class="fas fa-box"></i> <span>Produits</span>
        <span class="sidebar-count">{{ \App\Models\Product::count() }}</span>
      </a>
      <a href="{{ route('admin.orders.index') }}"
         class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart"></i> <span>Commandes</span>
        <span class="sidebar-count">{{ \App\Models\Order::count() }}</span>
      </a>

      {{-- Messages de contact --}}
      <a href="{{ route('admin.messages.index') }}"
         class="sidebar-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
        <i class="fas fa-envelope"></i> <span>Messages contact</span>
        @php
            $contactUnread = \App\Models\Contact::where('is_read', false)->count();
        @endphp
        @if($contactUnread > 0)
            <span class="sidebar-count" style="background: #ef4444;">{{ $contactUnread }}</span>
        @else
            <span class="sidebar-count">{{ $contactUnread }}</span>
        @endif
      </a>

      {{-- Demandes de devis --}}
      <a href="{{ route('admin.devis.index') }}"
         class="sidebar-link {{ request()->routeIs('admin.devis.*') ? 'active' : '' }}">
        <i class="fas fa-file-invoice"></i> <span>Demandes devis</span>
        @php
            $devisUnread = \App\Models\Devi::where('is_read', false)->count();
        @endphp
        @if($devisUnread > 0)
            <span class="sidebar-count" style="background: #ef4444;">{{ $devisUnread }}</span>
        @else
            <span class="sidebar-count">{{ $devisUnread }}</span>
        @endif
      </a>

      <div class="nav-section-label mt-3">Boutique</div>
      <a href="{{ route('boutique') }}" target="_blank" class="sidebar-link">
        <i class="fas fa-store"></i> <span>Voir la boutique</span>
        <i class="fas fa-external-link-alt" style="font-size:.65rem;margin-left:auto"></i>
      </a>
    </nav>

    <div class="sidebar-footer">
      <div class="sidebar-user">
        <div class="user-avatar">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</div>
        <div>
          <div style="font-size:.85rem;color:#fff;font-weight:600">{{ auth()->user()->name ?? 'Admin' }}</div>
          <div style="font-size:.72rem;color:#7a8599">Administrateur</div>
        </div>
      </div>
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="sidebar-logout" title="Déconnexion">
          <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
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
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('collapsed');
    }

    // Auto-hide success message after 5 seconds
    setTimeout(() => {
      const successMsg = document.querySelector('.admin-topbar span[style*="#22c55e"]');
      if (successMsg) {
        successMsg.style.opacity = '0';
        setTimeout(() => successMsg.remove(), 300);
      }
    }, 5000);
  </script>
  @stack('scripts')
</body>
</html>