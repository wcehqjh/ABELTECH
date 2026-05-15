<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="@yield('meta_desc', 'Abeltech — PC, Gaming, TV et accessoires au Maroc')">
  <title>@yield('title', 'Abeltech') — Votre boutique tech au Maroc</title>

  {{-- Bootstrap 5 --}}
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

  {{-- Font Awesome --}}
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  {{-- Google Fonts --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Syne:wght@400;600;700;800&display=swap"
        rel="stylesheet">

  {{-- CSS principal --}}
<link rel="stylesheet" href="{{ asset('assets/css/abeltech-style.css') }}?ngrok-skip-browser-warning=true">
  <style>
    /* Styles pour l'espace client */
    .dropdown-client {
      position: relative;
      display: inline-block;
    }

    .btn-client-dropdown {
      background: rgba(0,212,255,0.1);
      border: 1px solid rgba(0,212,255,0.3);
      padding: 8px 16px;
      border-radius: 40px;
      color: #00d4ff;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.3s ease;
    }

    .btn-client-dropdown:hover {
      background: rgba(0,212,255,0.2);
      transform: translateY(-2px);
    }

    .btn-client {
      background: linear-gradient(135deg, #00d4ff, #7c3aed);
      border: none;
      padding: 8px 18px;
      border-radius: 40px;
      color: #fff;
      font-weight: 600;
      font-size: 14px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
    }

    .btn-client:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0,212,255,0.3);
      color: #fff;
    }

    .client-dropdown-menu {
      position: absolute;
      top: 50px;
      right: 0;
      background: rgba(17, 19, 24, 0.98);
      backdrop-filter: blur(12px);
      border: 1px solid rgba(0,212,255,0.2);
      border-radius: 16px;
      min-width: 220px;
      padding: 8px 0;
      z-index: 1000;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s ease;
    }

    .client-dropdown-menu.show {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .client-dropdown-menu a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 20px;
      color: rgba(255,255,255,0.8);
      text-decoration: none;
      font-size: 14px;
      transition: all 0.2s;
    }

    .client-dropdown-menu a:hover {
      background: rgba(0,212,255,0.1);
      color: #00d4ff;
    }

    .dropdown-divider {
      height: 1px;
      background: rgba(255,255,255,0.1);
      margin: 8px 0;
    }

    .dropdown-logout {
      width: 100%;
      background: none;
      border: none;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      color: #ef4444;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .dropdown-logout:hover {
      background: rgba(239,68,68,0.1);
    }
  </style>

  @stack('styles')
</head>
<body>

{{-- ═══════════════════════════════════
     EFFETS DE FOND
     ═══════════════════════════════════ --}}
<div class="bg-effects" aria-hidden="true">
  <div class="bg-orb bg-orb-1"></div>
  <div class="bg-orb bg-orb-2"></div>
  <div class="bg-orb bg-orb-3"></div>
</div>
<div class="bg-grid" aria-hidden="true"></div>

{{-- ═══════════════════════════════════
     NAVBAR
     ═══════════════════════════════════ --}}
<nav class="navbar-abeltech">
  <div class="container">
    <div class="navbar-inner">

      {{-- Logo --}}
      <a href="{{ route('home') }}" class="navbar-logo">ABELTECH</a>

      {{-- Liens desktop --}}
      <ul class="navbar-links d-none d-lg-flex">
        <li>
          <a href="{{ route('home') }}"
             class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="fas fa-home me-1"></i> Accueil
          </a>
        </li>
        <li>
          <a href="{{ route('boutique') }}"
             class="{{ request()->routeIs('boutique') ? 'active' : '' }}">
            <i class="fas fa-store me-1"></i> Boutique
          </a>
        </li>
        <li>
          <a href="{{ route('services') }}"
             class="{{ request()->routeIs('services') ? 'active' : '' }}">
            <i class="fas fa-tools me-1"></i> Services
          </a>
        </li>
        <li>
          <a href="{{ route('contact') }}"
             class="{{ request()->routeIs('contact') ? 'active' : '' }}">
            <i class="fas fa-envelope me-1"></i> Contact
          </a>
        </li>
      </ul>

      {{-- Droite navbar --}}
      <div class="navbar-right">
        <a href="{{ route('devis') }}" class="btn-nav-devis d-none d-md-inline-flex">
          <i class="fas fa-file-invoice"></i> Devis gratuit
        </a>
        <a href="{{ route('cart.index') }}" class="btn-nav-cart">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-badge" id="cartBadge">0</span>
        </a>
        
        {{-- Espace Client --}}
        @auth
          <div class="dropdown-client">
            <button class="btn-client-dropdown" onclick="toggleClientMenu()">
              <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="client-dropdown-menu" id="clientMenu">
              <a href="{{ route('client.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Tableau de bord</a>
              <a href="{{ route('client.dashboard') }}#orders"><i class="fas fa-shopping-bag"></i> Mes commandes</a>
              <a href="{{ route('client.dashboard') }}#profile"><i class="fas fa-user-edit"></i> Mon profil</a>
              <div class="dropdown-divider"></div>
              <form method="POST" action="{{ route('client.logout') }}">
                @csrf
                <button type="submit" class="dropdown-logout"><i class="fas fa-sign-out-alt"></i> Se déconnecter</button>
              </form>
            </div>
          </div>
        @else
          <a href="{{ route('client.login') }}" class="btn-client">
            <i class="fas fa-user-plus me-2"></i> Créer un compte
          </a>
        @endauth

        {{-- Toggler mobile --}}
        <button class="navbar-toggler d-lg-none" id="mobileToggle" type="button"
                aria-label="Menu">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>

    {{-- Menu mobile --}}
    <div class="mobile-menu d-lg-none" id="mobileMenu">
      <a href="{{ route('home') }}"
         class="{{ request()->routeIs('home') ? 'active' : '' }}">
        <i class="fas fa-home me-2"></i> Accueil
      </a>
      <a href="{{ route('boutique') }}"
         class="{{ request()->routeIs('boutique') ? 'active' : '' }}">
        <i class="fas fa-store me-2"></i> Boutique
      </a>
      <a href="{{ route('services') }}"
         class="{{ request()->routeIs('services') ? 'active' : '' }}">
        <i class="fas fa-tools me-2"></i> Services
      </a>
      <a href="{{ route('contact') }}"
         class="{{ request()->routeIs('contact') ? 'active' : '' }}">
        <i class="fas fa-envelope me-2"></i> Contact
      </a>
      <a href="{{ route('devis') }}" class="btn-primary mt-2 w-100">
        <i class="fas fa-file-invoice me-2"></i> Devis gratuit
      </a>
    </div>
  </div>
</nav>

{{-- ═══════════════════════════════════
     FLASH MESSAGES
     ═══════════════════════════════════ --}}
@if (session('success'))
  <div class="flash-message flash-success" role="alert">
    <i class="fas fa-check-circle"></i>
    {{ session('success') }}
  </div>
@endif

@if (session('error'))
  <div class="flash-message flash-error" role="alert">
    <i class="fas fa-exclamation-circle"></i>
    {{ session('error') }}
  </div>
@endif

{{-- ═══════════════════════════════════
     CONTENU PRINCIPAL
     ═══════════════════════════════════ --}}
<main class="page-wrapper">
  @yield('content')
</main>

{{-- ═══════════════════════════════════
     FOOTER
     ═══════════════════════════════════ --}}
<footer class="site-footer">
  <div class="container">
    <div class="row g-5">

      {{-- Colonne logo --}}
      <div class="col-lg-4">
        <div class="footer-logo">ABELTECH</div>
        <p class="footer-desc">
          Votre partenaire de confiance pour l'informatique
          et le gaming au Maroc.
        </p>
        <div class="footer-socials">
          <a href="https://www.facebook.com/share/1AzatW9QgH/?mibextid=wwXIfr" target="_blank" class="social-btn" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://www.instagram.com/abeltech.ma?igsh=ZDdseW9oazZqa2c4" target="_blank" class="social-btn" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://wa.me/212661288129" target="_blank" class="social-btn" aria-label="WhatsApp">
            <i class="fab fa-whatsapp"></i>
          </a>
          <a href="https://www.tiktok.com/@abeltech.dakhla" target="_blank" class="social-btn" aria-label="TikTok">
            <i class="fab fa-tiktok"></i>
          </a>
        </div>
      </div>

      {{-- Navigation --}}
      <div class="col-sm-6 col-lg-2">
        <h5 class="footer-col-title">Navigation</h5>
        <ul class="footer-links">
          <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Accueil</a></li>
          <li><a href="{{ route('boutique') }}"><i class="fas fa-chevron-right"></i> Boutique</a></li>
          <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Services</a></li>
          <li><a href="{{ route('devis') }}"><i class="fas fa-chevron-right"></i> Devis</a></li>
          <li><a href="{{ route('contact') }}"><i class="fas fa-chevron-right"></i> Contact</a></li>
        </ul>
      </div>

      {{-- Services --}}
      <div class="col-sm-6 col-lg-3">
        <h5 class="footer-col-title">Services</h5>
        <ul class="footer-links">
          <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Vente PC & Portables</a></li>
          <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Accessoires Gaming</a></li>
          <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Réparation PC</a></li>
          <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Upgrade Matériel</a></li>
          <li><a href="{{ route('services') }}"><i class="fas fa-chevron-right"></i> Support Technique</a></li>
        </ul>
      </div>

      {{-- Contact --}}
      <div class="col-lg-3">
        <h5 class="footer-col-title">Contact</h5>
        <ul class="footer-links">
          <li>
            <a href="https://maps.google.com/?q=Dakhla+Maroc" target="_blank">
              <i class="fas fa-map-marker-alt"></i> massira 3 ville DAKHLA,Morocco ,73000
            </a>
          </li>
          <li>
            <a href="tel:+212661288129">
              <i class="fas fa-phone"></i> +212 6 61 28 81 29
            </a>
          </li>
          <li>
            <a href="mailto:contact@abeltech.ma">
              <i class="fas fa-envelope"></i> driss.khmissou@gmail.com
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fas fa-clock"></i> Lun–Sam : 9h–19h
            </a>
          </li>
        </ul>
      </div>

    </div>

    {{-- Footer bottom --}}
    <div class="footer-bottom">
      <p>© <span id="footerYear"></span> Abeltech — Tous droits réservés.</p>
    </div>
  </div>
</footer>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Année dynamique footer
  document.getElementById('footerYear').textContent = new Date().getFullYear();

  // Toggle menu mobile
  const toggle = document.getElementById('mobileToggle');
  const menu   = document.getElementById('mobileMenu');
  if (toggle && menu) {
    toggle.addEventListener('click', () => menu.classList.toggle('open'));
  }

  // Fonction pour mettre à jour le badge du panier
  function updateCartBadge() {
    fetch('/panier/count')
      .then(response => response.json())
      .then(data => {
        const badge = document.getElementById('cartBadge');
        if (badge) {
          const count = data.count || 0;
          badge.textContent = count;
          if (count > 0) {
            badge.style.display = 'flex';
          } else {
            badge.style.display = 'none';
          }
        }
      })
      .catch(error => console.error('Erreur:', error));
  }

  // Fonction pour basculer le menu client
  function toggleClientMenu() {
    const menu = document.getElementById('clientMenu');
    if (menu) {
      menu.classList.toggle('show');
    }
  }

  // Fermer le menu client quand on clique ailleurs
  document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.dropdown-client');
    const menu = document.getElementById('clientMenu');
    if (dropdown && !dropdown.contains(event.target)) {
      if (menu) menu.classList.remove('show');
    }
  });

  // Mettre à jour le badge au chargement de la page
  document.addEventListener('DOMContentLoaded', function() {
    updateCartBadge();
  });

  // Fonction pour ajouter au panier sans recharger la page
  function addToCart(productId, qty = 1) {
    fetch('{{ route("cart.add") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: JSON.stringify({
        product_id: productId,
        qty: qty
      })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        updateCartBadge();
        showNotification('Produit ajouté au panier !', 'success');
      } else {
        showNotification(data.message || 'Erreur', 'error');
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      showNotification('Une erreur est survenue', 'error');
    });
  }

  // Fonction pour afficher une notification
  function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `flash-message flash-${type}`;
    notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
    document.body.appendChild(notification);
    setTimeout(() => {
      notification.style.opacity = '0';
      setTimeout(() => notification.remove(), 300);
    }, 3000);
  }
</script>

@stack('scripts')
</body>
</html>