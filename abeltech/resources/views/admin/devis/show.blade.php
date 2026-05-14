@extends('layouts.admin')

@section('title', 'Demande de devis - ' . $devis->name)

@section('content')
<div style="background: rgba(18,20,27,0.9); border-radius:20px; border:1px solid rgba(0,212,255,0.1); overflow:hidden;">
    <div style="padding:20px 24px; border-bottom:1px solid rgba(0,212,255,0.1); background: rgba(0,0,0,0.3); display: flex; justify-content: space-between; align-items: center;">
        <h3 style="margin:0; color:#fff;">📋 Demande de devis #{{ $devis->id }}</h3>
        <a href="{{ route('admin.devis.index') }}" style="background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); padding:10px 20px; border-radius:12px; color:#ccc; text-decoration:none;">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
    
    <div style="padding: 24px;">
        <div style="margin-bottom:20px; display:flex; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:15px;">
            <div style="width:140px; font-size:12px; font-weight:600; color:#00d4ff;">Nom complet</div>
            <div style="flex:1; font-size:14px; color:#fff;">{{ $devis->name }}</div>
        </div>
        <div style="margin-bottom:20px; display:flex; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:15px;">
            <div style="width:140px; font-size:12px; font-weight:600; color:#00d4ff;">Email</div>
            <div style="flex:1; font-size:14px; color:#fff;">{{ $devis->email }}</div>
        </div>
        <div style="margin-bottom:20px; display:flex; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:15px;">
            <div style="width:140px; font-size:12px; font-weight:600; color:#00d4ff;">Téléphone</div>
            <div style="flex:1; font-size:14px; color:#fff;">{{ $devis->phone }}</div>
        </div>
        <div style="margin-bottom:20px; display:flex; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:15px;">
            <div style="width:140px; font-size:12px; font-weight:600; color:#00d4ff;">Service demandé</div>
            <div style="flex:1; font-size:14px; color:#fff;">{{ $devis->service }}</div>
        </div>
        <div style="margin-bottom:20px; display:flex; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:15px;">
            <div style="width:140px; font-size:12px; font-weight:600; color:#00d4ff;">Budget estimé</div>
            <div style="flex:1; font-size:14px; color:#fff;">{{ $devis->budget ?? 'Non spécifié' }}</div>
        </div>
        <div style="margin-bottom:20px; display:flex; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:15px;">
            <div style="width:140px; font-size:12px; font-weight:600; color:#00d4ff;">Délai souhaité</div>
            <div style="flex:1; font-size:14px; color:#fff;">{{ $devis->deadline ?? 'Non spécifié' }}</div>
        </div>
        <div style="margin-bottom:20px; display:flex; border-bottom:1px solid rgba(255,255,255,0.05); padding-bottom:15px;">
            <div style="width:140px; font-size:12px; font-weight:600; color:#00d4ff;">Date d'envoi</div>
            <div style="flex:1; font-size:14px; color:#fff;">{{ $devis->created_at->format('d/m/Y à H:i:s') }}</div>
        </div>
        
        <div style="background: rgba(0,0,0,0.3); border-radius:16px; padding:20px; margin-top:20px;">
            <div style="color:#00d4ff; margin-bottom:12px;">📝 Description du projet</div>
            <div style="color:#e0e0e0; line-height:1.6;">{{ nl2br(e($devis->description)) }}</div>
        </div>
        
        <div style="display:flex; gap:15px; margin-top:30px; padding-top:20px; border-top:1px solid rgba(255,255,255,0.05);">
            <a href="mailto:{{ $devis->email }}?subject=Réponse à votre demande de devis - Abeltech" style="background:linear-gradient(135deg,#00d4ff,#7c3aed); border:none; padding:12px 24px; border-radius:12px; color:#fff; text-decoration:none;">
                <i class="fas fa-reply"></i> Répondre par email
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $devis->phone) }}" target="_blank" style="background:transparent; border:1.5px solid #25D366; padding:12px 24px; border-radius:12px; color:#25D366; text-decoration:none;">
                <i class="fab fa-whatsapp"></i> Répondre sur WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
