@extends('layouts.admin')

@section('title', 'Messages')
@section('header_title', 'Gestion des messages')

@section('content')
<div class="admin-table-container">
    <div class="admin-table-header">
        <h3 class="admin-table-title">
            <i class="fas fa-envelope me-2"></i> Messages des clients
            @if($unreadCount > 0)
                <span class="badge-unread" style="background:#ef4444; color:white; padding:4px 12px; border-radius:20px;">
                    {{ $unreadCount }} non lu(s)
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
                <th>Message</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $message)
            <tr style="{{ !$message->is_read ? 'background: rgba(0,212,255,0.05);' : '' }}">
                <td>{{ $message->id }}</td>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ \Illuminate\Support\Str::limit($message->message, 50) }}</td>
                <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if(!$message->is_read)
                        <span style="background:rgba(239,68,68,0.15); padding:4px 12px; border-radius:20px; color:#ef4444;">Non lu</span>
                    @else
                        <span style="background:rgba(34,197,94,0.15); padding:4px 12px; border-radius:20px; color:#22c55e;">Lu</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.messages.show', $message->id) }}" style="background:rgba(0,212,255,0.15); padding:6px 12px; border-radius:8px; color:#00d4ff; text-decoration:none;">Voir</a>
                    <form method="POST" action="{{ route('admin.messages.destroy', $message->id) }}" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:rgba(239,68,68,0.15); border:none; padding:6px 12px; border-radius:8px; color:#ef4444; cursor:pointer;" onclick="return confirm('Supprimer ce message ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:40px;">Aucun message pour le moment</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:20px;">{{ $messages->links() }}</div>
</div>
@endsection
