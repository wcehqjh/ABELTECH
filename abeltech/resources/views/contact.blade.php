@extends('layouts.app')

@section('title', 'Contact')
@section('meta_desc', 'Contactez Abeltech pour toute question ou demande d\'assistance.')

@section('content')

<div class="page-hero">
  <div class="container" style="position:relative;z-index:1;">
    <div class="section-eyebrow" style="justify-content:center;">
      <span class="eyebrow-dot"></span> Parlons-en
    </div>
    <h1>Nous <span class="text-gradient">Contacter</span></h1>
    <p>Notre équipe est disponible du lundi au samedi, de 9h à 19h.</p>
  </div>
</div>

<section style="padding: 60px 0 90px;">
  <div class="container">
    <div class="row g-5 align-items-start">

      {{-- Formulaire --}}
      <div class="col-lg-7">
        <div class="admin-form-card">
          <h4 style="font-size: 18px; font-weight: 800; margin-bottom: 28px;">
            <i class="fas fa-paper-plane me-2" style="color:var(--cyan)"></i>
            Envoyer un message
          </h4>

          <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            <div class="row g-3">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Nom complet *</label>
                  <input type="text" name="name" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Téléphone *</label>
                  <input type="tel" name="phone" class="form-control" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label class="form-label">Email *</label>
                  <input type="email" name="email" class="form-control" required>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label class="form-label">Message *</label>
                  <textarea name="message" class="form-control" rows="5" required></textarea>
                </div>
              </div>
              <div class="col-12 mt-2">
                <button type="submit" class="btn-primary w-100" style="padding:14px;">
                  <i class="fas fa-paper-plane"></i> Envoyer le message
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      {{-- Informations de contact --}}
      <div class="col-lg-5">
        <div class="d-flex flex-column gap-3">

          <div style="background: rgba(255,255,255,0.03); border: 1.5px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 20px 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 46px; height: 46px; border-radius: 12px; background: #00d4ff18; color: #00d4ff; display: flex; align-items: center; justify-content: center; font-size: 18px;">
              <i class="fab fa-whatsapp"></i>
            </div>
            <div>
              <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.35);">WhatsApp</div>
              <div style="font-size: 14px; font-weight: 600; color: #fff;">
                <a href="https://wa.me/212661288129" style="color: #fff; text-decoration: none;">+212 6 61 28 81 29</a>
              </div>
            </div>
          </div>

          <div style="background: rgba(255,255,255,0.03); border: 1.5px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 20px 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 46px; height: 46px; border-radius: 12px; background: #22c55e18; color: #22c55e; display: flex; align-items: center; justify-content: center; font-size: 18px;">
              <i class="fab fa-instagram"></i>
            </div>
            <div>
              <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.35);">Instagram</div>
              <div style="font-size: 14px; font-weight: 600;">
                <a href="https://www.instagram.com/abeltech.ma" target="_blank" style="color: #fff; text-decoration: none;">@abeltech.ma</a>
              </div>
            </div>
          </div>

          <div style="background: rgba(255,255,255,0.03); border: 1.5px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 20px 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 46px; height: 46px; border-radius: 12px; background: #1877f218; color: #1877f2; display: flex; align-items: center; justify-content: center; font-size: 18px;">
              <i class="fab fa-facebook-f"></i>
            </div>
            <div>
              <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.35);">Facebook</div>
              <div style="font-size: 14px; font-weight: 600;">
                <a href="https://www.facebook.com/share/1AzatW9QgH/" target="_blank" style="color: #fff; text-decoration: none;">Abeltech Dakhla</a>
              </div>
            </div>
          </div>

          <div style="background: rgba(255,255,255,0.03); border: 1.5px solid rgba(255,255,255,0.07); border-radius: 14px; padding: 20px 22px; display: flex; align-items: center; gap: 16px;">
            <div style="width: 46px; height: 46px; border-radius: 12px; background: #00000018; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px;">
              <i class="fab fa-tiktok"></i>
            </div>
            <div>
              <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: rgba(255,255,255,0.35);">TikTok</div>
              <div style="font-size: 14px; font-weight: 600;">
                <a href="https://www.tiktok.com/@abeltech.dakhla" target="_blank" style="color: #fff; text-decoration: none;">@abeltech.dakhla</a>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

@endsection
