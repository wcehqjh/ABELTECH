{{-- resources/views/partials/navbar.blade.php --}}
{{-- ناڤبار ثابت لجميع الصفحات --}}

<style>
@import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Exo+2:wght@300;400;500&display=swap');

:root {
  --blue:   #1d6fff;
  --cyan:   #00e5ff;
  --violet: #7b2fff;
  --border: rgba(255,255,255,0.08);
  --font-h: 'Rajdhani', sans-serif;
  --font-b: 'Exo 2', sans-serif;
}

/* ===== NAVBAR ===== */
.ab-nav {
  position: fixed; top: 0; left: 0; right: 0;
  z-index: 9999;
  padding: 16px 0;
  transition: all 0.3s ease;
}
.ab-nav.scrolled {
  background: rgba(5, 8, 20, 0.95);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--border);
  padding: 10px 0;
}
.ab-nav-inner {
  max-width: 1280px; margin: 0 auto;
  padding: 0 24px;
  display: flex; align-items: center; justify-content: space-between;
}

/* Logo */
.ab-logo {
  font-family: var(--font-h);
  font-size: 1.8rem; font-weight: 700;
  text-decoration: none; color: #fff;
  display: flex; align-items: center; gap: 2px;
}
.ab-logo .tech { color: var(--cyan); }
.ab-logo .dot  {
  width: 8px; height: 8px; background: var(--cyan);
  border-radius: 50%; display: inline-block; margin-left: 3px;
  animation: abBlink 1.8s ease-in-out infinite;
}
@keyframes abBlink {
  0%,100% { opacity:1; transform:scale(1); }
  50%      { opacity:0.4; transform:scale(1.5); }
}

/* Links */
.ab-links {
  display: flex; align-items: center; gap: 4px;
  list-style: none; margin: 0; padding: 0;
}
.ab-links a {
  font-family: var(--font-h); font-size: 1rem; font-weight: 500;
  color: rgba(255,255,255,0.65); padding: 7px 16px;
  border-radius: 8px; text-decoration: none;
  transition: all 0.2s; position: relative;
}
.ab-links a::after {
  content: ''; position: absolute;
  bottom: 2px; left: 16px;
  width: 0; height: 2px;
  background: linear-gradient(90deg, var(--blue), var(--cyan));
  border-radius: 2px; transition: width 0.3s;
}
.ab-links a:hover,
.ab-links a.ab-active { color: #fff; }
.ab-links a:hover::after,
.ab-links a.ab-active::after { width: calc(100% - 32px); }

/* CTA */
.ab-cta {
  background: linear-gradient(135deg, var(--blue), var(--violet)) !important;
  color: #fff !important; border-radius: 100px !important;
  padding: 9px 22px !important; font-weight: 600 !important;
  box-shadow: 0 4px 20px rgba(29,111,255,0.35);
  display: flex !important; align-items: center; gap: 7px;
}
.ab-cta::after { display: none !important; }
.ab-cta:hover  { box-shadow: 0 8px 28px rgba(29,111,255,0.5); transform: translateY(-2px); }

/* Toggle mobile */
.ab-toggle {
  display: none; background: none;
  border: 1.5px solid rgba(255,255,255,0.2);
  border-radius: 8px; padding: 7px 11px; cursor: pointer;
  color: #fff; font-size: 1.1rem;
  transition: all 0.2s;
}
.ab-toggle:hover { border-color: var(--blue); }

/* Mobile menu */
.ab-mobile {
  display: none; overflow: hidden;
  background: rgba(5,8,20,0.98);
  border-top: 1px solid var(--border);
  padding: 0 24px;
  max-height: 0; transition: max-height 0.35s ease, padding 0.3s;
}
.ab-mobile.open {
  display: block; max-height: 400px;
  padding: 16px 24px 20px;
}
.ab-mobile ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px; }
.ab-mobile ul a {
  display: flex; align-items: center; gap: 10px;
  padding: 11px 14px; border-radius: 8px;
  color: rgba(255,255,255,0.7); text-decoration: none;
  font-family: var(--font-h); font-size: 1.05rem;
  transition: all 0.2s;
}
.ab-mobile ul a:hover { background: rgba(29,111,255,0.1); color: #fff; }
.ab-mobile .ab-cta-mobile {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  margin-top: 14px; padding: 13px;
  background: linear-gradient(135deg, var(--blue), var(--violet));
  color: #fff; border-radius: 100px;
  font-family: var(--font-h); font-size: 1rem; font-weight: 600;
  text-decoration: none;
}

@media (max-width: 992px) {
  .ab-links { display: none; }
  .ab-toggle { display: block; }
}
</style>

<nav class="ab-nav" id="abNav">
  <div class="ab-nav-inner">

    {{-- Logo --}}
    <a href="{{ url('/') }}" class="ab-logo">
      Abel<span class="tech">tech</span><span class="dot"></span>
    </a>

    {{-- Liens Desktop --}}
    <ul class="ab-links">
      <li>
        <a href="{{ url('/') }}"
           class="{{ request()->is('/') ? 'ab-active' : '' }}">
          Accueil
        </a>
      </li>
      <li>
        <a href="{{ url('/services') }}"
           class="{{ request()->is('services') ? 'ab-active' : '' }}">
          Services
        </a>
      </li>
      <li>
        <a href="{{ url('/boutique') }}"
           class="{{ request()->is('boutique') ? 'ab-active' : '' }}">
          Boutique
        </a>
      </li>
      <li>
        <a href="{{ url('/contact') }}"
           class="{{ request()->is('contact') ? 'ab-active' : '' }}">
          Contact
        </a>
      </li>
      <li>
        <a href="{{ url('/devis') }}" class="ab-cta">
          <i class="fas fa-file-invoice"></i> Devis gratuit
        </a>
      </li>
    </ul>

    {{-- Toggle Mobile --}}
    <button class="ab-toggle" onclick="abToggleMenu()" aria-label="Menu">
      <i class="fas fa-bars" id="abMenuIcon"></i>
    </button>
  </div>

  {{-- Menu Mobile --}}
  <div class="ab-mobile" id="abMobile">
    <ul>
      <li>
        <a href="{{ url('/') }}">
          <i class="fas fa-home"></i> Accueil
        </a>
      </li>
      <li>
        <a href="{{ url('/services') }}">
          <i class="fas fa-layer-group"></i> Services
        </a>
      </li>
      <li>
        <a href="{{ url('/boutique') }}">
          <i class="fas fa-store"></i> Boutique
        </a>
      </li>
      <li>
        <a href="{{ url('/contact') }}">
          <i class="fas fa-envelope"></i> Contact
        </a>
      </li>
    </ul>
    <a href="{{ url('/devis') }}" class="ab-cta-mobile">
      <i class="fas fa-file-invoice"></i> Demander un devis gratuit
    </a>
  </div>
</nav>

<script>
function abToggleMenu() {
  const menu = document.getElementById('abMobile');
  const icon = document.getElementById('abMenuIcon');
  menu.classList.toggle('open');
  icon.className = menu.classList.contains('open') ? 'fas fa-times' : 'fas fa-bars';
}
window.addEventListener('scroll', () => {
  document.getElementById('abNav').classList.toggle('scrolled', window.scrollY > 50);
}, { passive: true });
</script>