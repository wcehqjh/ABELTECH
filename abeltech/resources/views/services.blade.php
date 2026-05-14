@extends('layouts.app')

@section('title', 'Services')
@section('meta_desc', 'Découvrez tous les services Abeltech : réparation, upgrade, installation et support.')

@section('content')

<div class="page-hero">
  <div class="container" style="position:relative;z-index:1;">
    <div class="breadcrumb-abeltech justify-content-center mb-3">
      <a href="{{ route('home') }}">Accueil</a>
      <span class="sep"><i class="fas fa-chevron-right"></i></span>
      <span style="color:var(--cyan)">Services</span>
    </div>
    <div class="section-eyebrow" style="justify-content:center;">
      <span class="eyebrow-dot"></span> Ce que nous faisons
    </div>
    <h1>Nos <span class="text-gradient">Services</span></h1>
    <p>Une gamme complète de solutions informatiques et gaming pour particuliers et professionnels.</p>
  </div>
</div>

<section style="padding: 60px 0 90px;">
  <div class="container">

    <div class="row g-4">
      
      {{-- Service 1: Vente PC Portables --}}
      <div class="col-md-6 col-lg-4">
        <div class="service-card">
          <div class="service-image">
            <img src="{{ asset('assets/images/services/artisticoperations-laptop-3877800_1920.jpg') }}" alt="Vente PC Portables">
            <div class="service-overlay">
              <i class="fas fa-laptop"></i>
            </div>
          </div>
          <div class="service-content">
            <h3>💻 Vente PC Portables</h3>
            <p>Large choix toutes marques : HP, Dell, Lenovo, Asus, Acer…</p>
            <ul class="service-features">
              <li><i class="fas fa-check"></i> Toutes marques disponibles</li>
              <li><i class="fas fa-check"></i> Garantie fabricant incluse</li>
              <li><i class="fas fa-check"></i> Conseils personnalisés</li>
            </ul>
            <a href="{{ route('devis', ['service' => 'Vente PC Portables']) }}" class="btn-service">
              <i class="fas fa-file-invoice"></i> Demander un devis
            </a>
          </div>
        </div>
      </div>

      {{-- Service 2: Vente PC Bureau --}}
      <div class="col-md-6 col-lg-4">
        <div class="service-card">
          <div class="service-image">
            <img src="{{ asset('assets/images/services/setupx99-interior-design-8781907_1920.png') }}" alt="Vente PC Bureau">
            <div class="service-overlay">
              <i class="fas fa-desktop"></i>
            </div>
          </div>
          <div class="service-content">
            <h3>🖥️ Vente PC Bureau</h3>
            <p>Assemblage PC sur mesure selon votre budget et vos besoins.</p>
            <ul class="service-features">
              <li><i class="fas fa-check"></i> Assemblage sur mesure</li>
              <li><i class="fas fa-check"></i> Configs gaming & pro</li>
              <li><i class="fas fa-check"></i> Installation système incluse</li>
            </ul>
            <a href="{{ route('devis', ['service' => 'Vente PC Bureau']) }}" class="btn-service">
              <i class="fas fa-file-invoice"></i> Demander un devis
            </a>
          </div>
        </div>
      </div>

      {{-- Service 3: Accessoires Gaming --}}
      <div class="col-md-6 col-lg-4">
        <div class="service-card">
          <div class="service-image">
            <img src="{{ asset('assets/images/services/pexels-cottonbro-3945683.jpg') }}" alt="Accessoires Gaming">
            <div class="service-overlay">
              <i class="fas fa-gamepad"></i>
            </div>
          </div>
          <div class="service-content">
            <h3>🎮 Accessoires Gaming</h3>
            <p>Claviers mécaniques, souris, casques 7.1, écrans haute fréquence.</p>
            <ul class="service-features">
              <li><i class="fas fa-check"></i> Marques : Logitech, Razer, HyperX</li>
              <li><i class="fas fa-check"></i> Éclairage RGB disponible</li>
              <li><i class="fas fa-check"></i> Conseils gaming pro</li>
            </ul>
            <a href="{{ route('devis', ['service' => 'Accessoires Gaming']) }}" class="btn-service">
              <i class="fas fa-file-invoice"></i> Demander un devis
            </a>
          </div>
        </div>
      </div>

      {{-- Service 4: Réparation PC --}}
      <div class="col-md-6 col-lg-4">
        <div class="service-card">
          <div class="service-image">
            <img src="{{ asset('assets/images/services/geralt-binary-2372130_1920.jpg') }}" alt="Réparation PC">
            <div class="service-overlay">
              <i class="fas fa-tools"></i>
            </div>
          </div>
          <div class="service-content">
            <h3>🔧 Réparation PC</h3>
            <p>Diagnostic complet, réparation pannes, remplacement composants défectueux.</p>
            <ul class="service-features">
              <li><i class="fas fa-check"></i> Diagnostic offert</li>
              <li><i class="fas fa-check"></i> Réparation écran & clavier</li>
              <li><i class="fas fa-check"></i> Nettoyage & pâte thermique</li>
            </ul>
            <a href="{{ route('devis', ['service' => 'Réparation PC']) }}" class="btn-service">
              <i class="fas fa-file-invoice"></i> Demander un devis
            </a>
          </div>
        </div>
      </div>

      {{-- Service 5: Upgrade Matériel --}}
      <div class="col-md-6 col-lg-4">
        <div class="service-card">
          <div class="service-image">
            <img src="{{ asset('assets/images/services/kieutruongphoto-computer-7775457_1920.jpg') }}" alt="Upgrade Matériel">
            <div class="service-overlay">
              <i class="fas fa-microchip"></i>
            </div>
          </div>
          <div class="service-content">
            <h3>⚡ Upgrade (RAM, SSD…)</h3>
            <p>Donnez une seconde vie à votre PC avec un upgrade matériel.</p>
            <ul class="service-features">
              <li><i class="fas fa-check"></i> RAM : 8 Go, 16 Go, 32 Go</li>
              <li><i class="fas fa-check"></i> SSD NVMe ultra-rapide</li>
              <li><i class="fas fa-check"></i> Migration de données incluse</li>
            </ul>
            <a href="{{ route('devis', ['service' => 'Upgrade Matériel']) }}" class="btn-service">
              <i class="fas fa-file-invoice"></i> Demander un devis
            </a>
          </div>
        </div>
      </div>



      {{-- Service 8: Formatage & Installation --}}
      <div class="col-md-6 col-lg-4">
        <div class="service-card">
          <div class="service-image">
            <img src="{{ asset('assets/images/services/npxl_studio-wallpaper-7056240_1920.jpg') }}" alt="Formatage & Installation">
            <div class="service-overlay">
              <i class="fas fa-window-restore"></i>
            </div>
          </div>
          <div class="service-content">
            <h3>💿 Formatage & Installation</h3>
            <p>Réinstallation propre de Windows 10/11, drivers et logiciels.</p>
            <ul class="service-features">
              <li><i class="fas fa-check"></i> Windows 10 & 11</li>
              <li><i class="fas fa-check"></i> Sauvegarde données incluse</li>
              <li><i class="fas fa-check"></i> Antivirus & sécurisation</li>
            </ul>
            <a href="{{ route('devis', ['service' => 'Formatage & Installation']) }}" class="btn-service">
              <i class="fas fa-file-invoice"></i> Demander un devis
            </a>
          </div>
        </div>
      </div>

      {{-- Service 9: Support Technique --}}
      <div class="col-md-6 col-lg-4">
        <div class="service-card">
          <div class="service-image">
            <img src="{{ asset('assets/images/services/pexels-tima-miroshnichenko-5453844.jpg') }}" alt="Support Technique">
            <div class="service-overlay">
              <i class="fas fa-headset"></i>
            </div>
          </div>
          <div class="service-content">
            <h3>🛠️ Support Technique</h3>
            <p>Assistance à distance ou sur site pour vos problèmes informatiques.</p>
            <ul class="service-features">
              <li><i class="fas fa-check"></i> Assistance à distance</li>
              <li><i class="fas fa-check"></i> Configuration réseau & WiFi</li>
              <li><i class="fas fa-check"></i> Intervention rapide</li>
            </ul>
            <a href="{{ route('devis', ['service' => 'Support Technique']) }}" class="btn-service">
              <i class="fas fa-file-invoice"></i> Demander un devis
            </a>
          </div>
        </div>
      </div>

    </div>

    {{-- CTA --}}
    <div class="mt-5">
      <div class="cta-strip">
        <h2>Vous ne trouvez pas ce dont<br>vous avez <span class="text-gradient">besoin</span> ?</h2>
        <p>Contactez-nous, nous trouverons ensemble la meilleure solution.</p>
        <a href="{{ route('contact') }}" class="btn-primary" style="position:relative;z-index:1;">
          <i class="fas fa-headset"></i> Contacter notre équipe
        </a>
      </div>
    </div>

  </div>
</section>

<style>
/* Service Cards Styles */
.service-card {
  background: rgba(18, 20, 27, 0.8);
  backdrop-filter: blur(12px);
  border-radius: 20px;
  overflow: hidden;
  transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
  border: 1px solid rgba(255,255,255,0.05);
  height: 100%;
}

.service-card:hover {
  transform: translateY(-8px);
  border-color: rgba(0,212,255,0.3);
  box-shadow: 0 20px 40px rgba(0,0,0,0.4), 0 0 20px rgba(0,212,255,0.1);
}

.service-image {
  position: relative;
  height: 200px;
  overflow: hidden;
}

.service-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.service-card:hover .service-image img {
  transform: scale(1.08);
}

.service-overlay {
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

.service-card:hover .service-overlay {
  opacity: 1;
}

.service-overlay i {
  font-size: 48px;
  color: #fff;
  text-shadow: 0 0 20px rgba(0,212,255,0.5);
}

.service-content {
  padding: 24px;
}

.service-content h3 {
  font-size: 18px;
  font-weight: 800;
  margin-bottom: 12px;
  color: #fff;
}

.service-content p {
  font-size: 13px;
  color: rgba(255,255,255,0.55);
  line-height: 1.6;
  margin-bottom: 16px;
}

.service-features {
  list-style: none;
  padding: 0;
  margin: 0 0 20px 0;
}

.service-features li {
  padding: 6px 0;
  color: rgba(255,255,255,0.6);
  font-size: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
  border-bottom: 1px solid rgba(255,255,255,0.03);
}

.service-features li i {
  color: #00d4ff;
  font-size: 10px;
  width: 16px;
}

.btn-service {
  background: linear-gradient(135deg, #00d4ff, #7c3aed);
  border: none;
  padding: 10px 20px;
  border-radius: 40px;
  color: #fff;
  font-weight: 600;
  font-size: 13px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
  width: 100%;
  justify-content: center;
}

.btn-service:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(0,212,255,0.3);
  color: #fff;
}

@media (max-width: 768px) {
  .service-image {
    height: 160px;
  }
  
  .service-content {
    padding: 18px;
  }
  
  .service-content h3 {
    font-size: 16px;
  }
}
</style>

@endsection