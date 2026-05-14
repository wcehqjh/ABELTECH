@extends('layouts.app')

@section('title', 'Accueil')
@section('meta_desc', 'Abeltech — PC, Gaming, TV et accessoires au Maroc.')

@section('content')

{{-- ── HERO ── --}}
<section style="padding: 90px 0 70px; text-align: center;">
  <div class="container">

    <div class="section-eyebrow">
      <span class="eyebrow-dot"></span>
      Bienvenue chez Abeltech
    </div>

    <h1 style="
      font-family: 'Orbitron', monospace;
      font-size: clamp(36px, 6vw, 72px);
      font-weight: 900;
      line-height: 1.05;
      margin-bottom: 22px;
    ">
      Votre <span class="text-gradient">Tech Store</span><br>
      au Maroc
    </h1>

    <p style="
      color: rgba(255,255,255,0.5);
      font-size: 16px;
      max-width: 500px;
      margin: 0 auto 40px;
      line-height: 1.75;
    ">
      PC portables, gaming, télévisions, consoles et accessoires —
      tout pour votre setup parfait.
    </p>

    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <a href="{{ route('boutique') }}" class="btn-primary">
        <i class="fas fa-store"></i> Voir la boutique
      </a>
      <a href="{{ route('devis') }}" class="btn-outline">
        <i class="fas fa-file-invoice"></i> Devis gratuit
      </a>
    </div>


    {{-- معلومات الأمان --}}
    <div class="mt-4">
      <small style="color: rgba(255,255,255,0.3);">
        <i class="fas fa-shield-alt me-1"></i> 
        Espace sécurisé · Gérez vos commandes · Suivez vos devis
      </small>
    </div>

  </div>
</section>

{{-- ── STATS ── --}}
<section style="border-top: 1px solid rgba(255,255,255,0.07); border-bottom: 1px solid rgba(255,255,255,0.07); padding: 32px 0;">
  <div class="container">
    <div class="d-flex justify-content-center flex-wrap gap-5">
      @foreach([
        ['2400+',  'Produits'],
        ['98%',    'Satisfaction'],
        ['24h',    'Livraison'],
        ['5 ★',   'Note client'],
      ] as [$val, $lbl])
        <div class="text-center">
          <div style="
            font-family: 'Orbitron', monospace;
            font-size: 26px;
            font-weight: 700;
            background: linear-gradient(135deg,#00d4ff,#7c3aed);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 4px;
          ">{{ $val }}</div>
          <div style="font-size: 11px; color: rgba(255,255,255,0.35); text-transform: uppercase; letter-spacing: 1px;">
            {{ $lbl }}
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ── CATÉGORIES AVEC IMAGES ANIMÉES ── --}}
<section style="padding: 72px 0;">
  <div class="container">

    <div class="text-center mb-5">
      <div class="section-eyebrow" style="justify-content: center;">
        <span class="eyebrow-dot"></span> Nos catégories
      </div>
      <h2 style="font-family:'Orbitron',monospace; font-size: clamp(22px,4vw,36px); font-weight:800;">
        Explorez notre <span class="text-gradient">catalogue</span>
      </h2>
    </div>

    <div class="row g-4">
      
      {{-- Catégorie 1: PC Portables --}}
      <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('boutique', ['category' => 'laptop']) }}" class="category-card">
          <div class="category-image">
            <img src="{{ asset('assets/images/categories/laptop.jpg') }}" alt="PC Portables">
            <div class="category-overlay">
              <span class="category-icon">💻</span>
            </div>
          </div>
          <div class="category-info">
            <h3>PC Portables</h3>
            <p>Ultrabooks, gaming & créatifs</p>
          </div>
        </a>
      </div>

      {{-- Catégorie 2: PC Bureau --}}
      <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('boutique', ['category' => 'desktop']) }}" class="category-card">
          <div class="category-image">
            <img src="{{ asset('assets/images/categories/200 (3).webp') }}" alt="PC Bureau">
            <div class="category-overlay">
              <span class="category-icon">🖥️</span>
            </div>
          </div>
          <div class="category-info">
            <h3>PC Bureau</h3>
            <p>Tours gaming & workstations</p>
          </div>
        </a>
      </div>

      {{-- Catégorie 3: Consoles --}}
      <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('boutique', ['category' => 'console']) }}" class="category-card">
          <div class="category-image">
            <img src="{{ asset('assets/images/categories/200 (1).webp') }}" alt="Consoles">
            <div class="category-overlay">
              <span class="category-icon">🕹️</span>
            </div>
          </div>
          <div class="category-info">
            <h3>Consoles</h3>
            <p>PS5, Xbox & accessoires</p>
          </div>
        </a>
      </div>

      {{-- Catégorie 4: Télévisions --}}
      <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('boutique', ['category' => 'tv']) }}" class="category-card">
          <div class="category-image">
            <img src="{{ asset('assets/images/categories/giphy.webp') }}" alt="Télévisions">
            <div class="category-overlay">
              <span class="category-icon">📺</span>
            </div>
          </div>
          <div class="category-info">
            <h3>Ecran</h3>
            <p>Asus,dell,gaming</p>
          </div>
        </a>
      </div>

      {{-- Catégorie 5: Accessoires --}}
      <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('boutique', ['category' => 'accessory']) }}" class="category-card">
          <div class="category-image">
            <img src="{{ asset('assets/images/categories/200 (2).webp') }}" alt="Accessoires">
            <div class="category-overlay">
              <span class="category-icon">🖱️</span>
            </div>
          </div>
          <div class="category-info">
            <h3>Accessoires</h3>
            <p>Souris, claviers & casques</p>
          </div>
        </a>
      </div>

      {{-- Catégorie 6: Pièces PC --}}
      <div class="col-6 col-md-4 col-lg-2">
        <a href="{{ route('boutique', ['category' => 'component']) }}" class="category-card">
          <div class="category-image">
            <img src="{{ asset('assets/images/categories/200 (4).webp') }}" alt="Pièces PC">
            <div class="category-overlay">
              <span class="category-icon">⚡</span>
            </div>
          </div>
          <div class="category-info">
            <h3>Pièces PC</h3>
            <p>GPU, RAM, SSD & boîtiers</p>
          </div>
        </a>
      </div>

    </div>

  </div>
</section>

{{-- ── CTA ── --}}
<section style="padding: 0 0 80px;">
  <div class="container">
    <div class="cta-strip">
      <h2>Besoin d'un <span class="text-gradient">devis personnalisé</span> ?</h2>
      <p>Contactez-nous, nous trouvons ensemble la meilleure solution pour votre budget.</p>
      <div class="d-flex justify-content-center gap-3 flex-wrap" style="position:relative;z-index:1;">
        <a href="{{ route('devis') }}" class="btn-primary">
          <i class="fas fa-file-invoice"></i> Demander un devis
        </a>
        <a href="{{ route('contact') }}" class="btn-outline">
          <i class="fas fa-headset"></i> Nous contacter
        </a>
      </div>
    </div>
  </div>
</section>

<style>
/* Category Cards avec images animées */
.category-card {
  display: block;
  text-decoration: none;
  background: rgba(18, 20, 27, 0.6);
  backdrop-filter: blur(12px);
  border-radius: 20px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
  border: 1px solid rgba(255,255,255,0.07);
}

.category-card:hover {
  transform: translateY(-8px);
  border-color: rgba(0,212,255,0.4);
  box-shadow: 0 20px 35px rgba(0,0,0,0.4), 0 0 20px rgba(0,212,255,0.2);
}

.category-image {
  position: relative;
  height: 160px;
  overflow: hidden;
}

.category-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.category-card:hover .category-image img {
  transform: scale(1.1);
}

.category-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, rgba(0,212,255,0.2), rgba(124,58,237,0.2));
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.category-card:hover .category-overlay {
  opacity: 1;
}

.category-icon {
  font-size: 48px;
  filter: drop-shadow(0 0 15px rgba(0,212,255,0.5));
  animation: pulse 1.5s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.1); }
}

.category-info {
  padding: 16px;
  text-align: center;
}

.category-info h3 {
  font-size: 14px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 5px;
}

.category-info p {
  font-size: 11px;
  color: rgba(255,255,255,0.4);
  margin: 0;
}

/* ========== BOUTONS CLIENT ========== */
.btn-login-client {
  background: linear-gradient(135deg, #00d4ff, #7c3aed);
  border: none;
  padding: 12px 28px;
  border-radius: 40px;
  color: #fff;
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  transition: all 0.3s ease;
}

.btn-login-client:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,212,255,0.4);
  color: #fff;
}

.btn-register-client {
  background: transparent;
  border: 1.5px solid #00d4ff;
  padding: 12px 28px;
  border-radius: 40px;
  color: #00d4ff;
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  transition: all 0.3s ease;
}

.btn-register-client:hover {
  background: rgba(0,212,255,0.1);
  transform: translateY(-2px);
  color: #00d4ff;
}

/* Responsive */
@media (max-width: 768px) {
  .category-image {
    height: 120px;
  }
  
  .category-icon {
    font-size: 32px;
  }
  
  .category-info h3 {
    font-size: 12px;
  }
  
  .category-info p {
    font-size: 9px;
  }
  
  .btn-login-client, .btn-register-client {
    padding: 10px 20px;
    font-size: 13px;
  }
}

/* Animation d'entrée */
@keyframes fadeInScale {
  from {
    opacity: 0;
    transform: scale(0.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.category-card {
  animation: fadeInScale 0.5s ease forwards;
}

/* Delay pour chaque carte */
.col-6:nth-child(1) .category-card { animation-delay: 0.1s; }
.col-6:nth-child(2) .category-card { animation-delay: 0.2s; }
.col-6:nth-child(3) .category-card { animation-delay: 0.3s; }
.col-6:nth-child(4) .category-card { animation-delay: 0.4s; }
.col-6:nth-child(5) .category-card { animation-delay: 0.5s; }
.col-6:nth-child(6) .category-card { animation-delay: 0.6s; }
</style>

@endsection
