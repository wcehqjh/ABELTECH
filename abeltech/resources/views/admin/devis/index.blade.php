@extends('layouts.admin')

@section('title', 'Demandes de devis')
@section('header_title', 'Gestion des demandes de devis')

@section('content')
<div class="admin-table-container">
    <div class="admin-table-header">
        <h3 class="admin-table-title">
            <i class="fas fa-file-invoice me-2"></i> Demandes de devis
            @if($unreadCount > 0)
                <span class="badge-unread" style="background:#ef4444; color:white; padding:4px 12px; border-radius:20px;">
                    {{ $unreadCount }} non lue(s)
                </span>
            @endif
        </h3>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Service</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($devis as $item)
            <tr style="{{ !$item->is_read ? 'background: rgba(0,212,255,0.05);' : '' }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->service }}</td>
                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if(!$item->is_read)
                        <span style="background:rgba(239,68,68,0.15); padding:4px 12px; border-radius:20px; color:#ef4444;">Non lue</span>
                    @else
                        <span style="background:rgba(34,197,94,0.15); padding:4px 12px; border-radius:20px; color:#22c55e;">Lue</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.devis.show', $item->id) }}" style="background:rgba(0,212,255,0.15); padding:6px 12px; border-radius:8px; color:#00d4ff; text-decoration:none;">Voir</a>
                    <form method="POST" action="{{ route('admin.devis.destroy', $item->id) }}" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:rgba(239,68,68,0.15); border:none; padding:6px 12px; border-radius:8px; color:#ef4444; cursor:pointer;" onclick="return confirm('Supprimer cette demande ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:40px;">Aucune demande de devis pour le moment</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:20px;">{{ $devis->links() }}</div>
</div>
@endsection
