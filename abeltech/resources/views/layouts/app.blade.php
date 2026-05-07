<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="@yield('meta_description', 'Abeltech – PC, Gaming, TV et accessoires au Maroc')">
  <title>@yield('title', 'Abeltech') – Votre boutique tech au Maroc</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- TON CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  
  @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
@include('partials.navbar')

{{-- FLASH MESSAGES --}}
@if(session('success'))
  <div class="alert-flash alert-flash-success">
    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
  </div>
@endif

{{-- CONTENU --}}
@yield('content')

{{-- FOOTER --}}
@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@stack('scripts')
</body>
</html>