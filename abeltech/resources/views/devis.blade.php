@extends('layouts.app')

@section('title', 'Demande de devis')
@section('meta_desc', 'Demandez un devis gratuit chez Abeltech pour votre projet informatique.')

@section('content')

<div class="page-hero">
  <div class="container" style="position:relative;z-index:1;">
    <div class="section-eyebrow" style="justify-content:center;">
      <span class="eyebrow-dot"></span> Gratuit & sans engagement
    </div>
    <h1>Demande de <span class="text-gradient">Devis</span></h1>
    <p>Remplissez le formulaire ci-dessous, nous vous répondons sous 24h.</p>
  </div>
</div>

<section style="padding: 60px 0 90px;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="admin-form-card">

          <h4 style="font-size: 18px; font-weight: 800; margin-bottom: 28px;">
            <i class="fas fa-file-invoice me-2" style="color:var(--cyan)"></i>
            Votre demande de devis
          </h4>

          <form action="#" method="POST">
            @csrf
            <div class="row g-3">

              {{-- Infos personnelles --}}
              <div class="col-md-6">
                <label class="form-label">Nom complet *</label>
                <input type="text" name="name" class="form-control"
                       placeholder="Mohammed Alami" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Téléphone *</label>
                <input type="tel" name="phone" class="form-control"
                       placeholder="+212 6 00 00 00 00" required>
              </div>
              <div class="col-12">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control"
                       placeholder="vous@email.com" required>
              </div>

              {{-- Séparateur --}}
              <div class="col-12">
                <div style="
                  height: 1px;
                  background: linear-gradient(90deg, transparent, rgba(0,212,255,0.2), transparent);
                  margin: 8px 0;
                "></div>
              </div>

              {{-- Type service --}}
              <div class="col-md-6">
                <label class="form-label">Service souhaité *</label>
                <select name="service" class="form-control" required>
                  <option value="">Choisir un service…</option>
                  <option value="Vente PC Portables"    {{ request('service') === 'Vente PC Portables'    ? 'selected' : '' }}>💻 Vente PC Portables</option>
                  <option value="Vente PC Bureau"       {{ request('service') === 'Vente PC Bureau'       ? 'selected' : '' }}>🖥️ Vente PC Bureau</option>
                  <option value="Accessoires Gaming"    {{ request('service') === 'Accessoires Gaming'    ? 'selected' : '' }}>🎮 Accessoires Gaming</option>
                  <option value="Réparation PC"         {{ request('service') === 'Réparation PC'         ? 'selected' : '' }}>🔧 Réparation PC</option>
                  <option value="Upgrade Matériel"      {{ request('service') === 'Upgrade Matériel'      ? 'selected' : '' }}>⚡ Upgrade Matériel</option>
                  <option value="Réparation PlayStation"{{ request('service') === 'Réparation PlayStation'? 'selected' : '' }}>🕹️ Réparation PlayStation</option>
                  <option value="Formatage & Installation"{{ request('service') === 'Formatage & Installation'? 'selected' : '' }}>💿 Formatage & Installation</option>
                  <option value="Support Technique"     {{ request('service') === 'Support Technique'     ? 'selected' : '' }}>🛠️ Support Technique</option>
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label">Budget estimé</label>
                <select name="budget" class="form-control">
                  <option value="">Non défini</option>
                  <option>Moins de 2 000 MAD</option>
                  <option>2 000 – 5 000 MAD</option>
                  <option>5 000 – 10 000 MAD</option>
                  <option>10 000 – 20 000 MAD</option>
                  <option>Plus de 20 000 MAD</option>
                </select>
              </div>

              <div class="col-12">
                <label class="form-label">Délai souhaité</label>
                <select name="deadline" class="form-control">
                  <option value="">Non défini</option>
                  <option>Urgent (moins de 48h)</option>
                  <option>Cette semaine</option>
                  <option>Ce mois-ci</option>
                  <option>Pas de délai précis</option>
                </select>
              </div>

              <div class="col-12">
                <label class="form-label">Description du projet *</label>
                <textarea name="description" class="form-control"
                          rows="5"
                          placeholder="Décrivez votre projet, vos besoins, la configuration souhaitée…"
                          required></textarea>
              </div>

              <div class="col-12 mt-2">
                <button type="submit" class="btn-primary w-100" style="padding:15px; font-size:14px;">
                  <i class="fas fa-paper-plane"></i> Envoyer ma demande
                </button>
              </div>

              <div class="col-12 text-center">
                <p style="font-size: 12px; color: rgba(255,255,255,0.3); margin-top: 8px;">
                  <i class="fas fa-lock me-1"></i>
                  Vos données sont confidentielles et ne seront jamais partagées.
                </p>
              </div>

            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection