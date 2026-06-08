@extends('admin.layouts.admin')

@section('title', 'Inscriptions')

@section('content')

<div class="page-header">
    <h1 class="page-title">Inscriptions</h1>
    <span class="page-count">{{ $subscriptions->count() }} inscription(s)</span>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-card">
    <div class="table-card-header">
        <h3>Liste des inscriptions</h3>
        <span class="page-count">{{ $subscriptions->count() }} total</span>
    </div>
    <div class="table-scroll">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Candidat</th>
                    <th>Email</th>
                    <th>Pays</th>
                    <th>Categories</th>
                    <th>Paiement</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $sub)
                    @php
                        $payment = $payments[$sub->email] ?? null;
                    @endphp
                    <tr>
                        <td class="cell-name">
                            <span class="avatar">{{ substr($sub->fullname, 0, 2) }}</span>
                            <button class="name-link" onclick="openModal({{ $sub->id }})">{{ $sub->fullname }}</button>
                        </td>
                        <td class="cell-email">{{ $sub->email }}</td>
                        <td class="cell-dim">{{ $sub->country }}</td>
                        <td>
                            @php
                                $categories = is_array($sub->categories)
                                    ? $sub->categories
                                    : json_decode($sub->categories, true);
                            @endphp
                            <div class="tags">
                                @if(!empty($categories))
                                    @foreach(array_slice($categories, 0, 2) as $category)
                                        <span class="tag">{{ $category }}</span>
                                    @endforeach
                                    @if(count($categories) > 2)
                                        <span class="tag tag-more">+{{ count($categories) - 2 }}</span>
                                    @endif
                                @else
                                    <span class="tag tag-muted">-</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if($sub->payment_reference)
                                <span class="dot dot-green"></span>
                                <span class="label label-green">Paye</span>
                            @else
                                <span class="dot dot-amber"></span>
                                <span class="label label-amber">Impaye</span>
                            @endif
                        </td>
                        <td>
                            @switch($sub->status)
                                @case('pending')
                                    <span class="label label-amber">En attente</span>
                                    @break
                                @case('approved')
                                    <span class="label label-green">Approuve</span>
                                    @break
                                @case('rejected')
                                    <span class="label label-red">Rejete</span>
                                    @break
                                @case('sent')
                                    <span class="label label-blue">Envoye</span>
                                    @break
                                @case('received')
                                    <span class="label label-purple">Recu</span>
                                    @break
                                @default
                                    <span class="label">{{ $sub->status }}</span>
                            @endswitch
                        </td>
                        <td class="cell-date">{{ $sub->created_at->format('d/m/Y H:i') }}</td>
                        <td class="cell-actions">
                            <form action="{{ route('admin.subscriptions.approve', $sub->id) }}" method="POST" class="inline-form">
                                @csrf
                                <button class="btn btn-sm btn-success"
                                    {{ $sub->status !== 'pending' ? 'disabled' : '' }}
                                    title="Approuver">Approuver</button>
                            </form>
                            <form action="{{ route('admin.subscriptions.reject', $sub->id) }}" method="POST" class="inline-form">
                                @csrf
                                <button class="btn btn-sm btn-danger"
                                    {{ $sub->status !== 'pending' ? 'disabled' : '' }}
                                    title="Rejeter">Rejeter</button>
                            </form>
                            <form action="{{ route('admin.subscriptions.sent', $sub->id) }}" method="POST" class="inline-form">
                                @csrf
                                <button class="btn btn-sm btn-ghost"
                                    {{ $sub->status !== 'approved' ? 'disabled' : '' }}
                                    title="Marquer comme envoye">Envoyer</button>
                            </form>
                            <form action="{{ route('admin.subscriptions.received', $sub->id) }}" method="POST" class="inline-form">
                                @csrf
                                <button class="btn btn-sm btn-ghost"
                                    {{ $sub->status !== 'sent' ? 'disabled' : '' }}
                                    title="Marquer comme recu">Recevoir</button>
                            </form>
                        </td>
                    </tr>

                    {{-- MODAL DETAILS --}}
                    <div id="modal-{{ $sub->id }}" class="modal-overlay" onclick="closeModal({{ $sub->id }})">
                        <div class="modal-card" onclick="event.stopPropagation()">
                            <div class="modal-header">
                                <h3>{{ $sub->fullname }}</h3>
                                <button class="modal-close" onclick="closeModal({{ $sub->id }})">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="detail-section">
                                    <h4>Inscription</h4>
                                    <div class="detail-grid">
                                        <div class="detail-item">
                                            <span class="detail-label">Nom complet</span>
                                            <span class="detail-value">{{ $sub->fullname }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Email</span>
                                            <span class="detail-value">{{ $sub->email }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Pays</span>
                                            <span class="detail-value">{{ $sub->country }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Acteur #</span>
                                            <span class="detail-value">{{ $sub->actor_id ?? '-' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Categories</span>
                                            <span class="detail-value">
                                                @if(!empty($categories))
                                                    @foreach($categories as $cat)
                                                        <span class="tag">{{ $cat }}</span>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Statut</span>
                                            <span class="detail-value">
                                                @switch($sub->status)
                                                    @case('pending') En attente @break
                                                    @case('approved') Approuve @break
                                                    @case('rejected') Rejete @break
                                                    @case('sent') Envoye @break
                                                    @case('received') Recu @break
                                                @endswitch
                                            </span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Date d'inscription</span>
                                            <span class="detail-value">{{ $sub->created_at->format('d/m/Y H:i:s') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="detail-section">
                                    <h4>Paiement</h4>
                                    @if($payment)
                                        <div class="detail-grid">
                                            <div class="detail-item">
                                                <span class="detail-label">Reference</span>
                                                <span class="detail-value">{{ $payment->reference }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Montant</span>
                                                <span class="detail-value">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Methode</span>
                                                <span class="detail-value">{{ strtoupper($payment->method) }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Statut paiement</span>
                                                <span class="detail-value">
                                                    @php $ps = strtolower($payment->status); @endphp
                                                    @if($ps === 'success')
                                                        <span class="label label-green">Valide</span>
                                                    @elseif($ps === 'pending')
                                                        <span class="label label-amber">En attente</span>
                                                    @else
                                                        <span class="label label-red">Echoue</span>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Date paiement</span>
                                                <span class="detail-value">{{ $payment->created_at->format('d/m/Y H:i:s') }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <p class="no-payment">Aucun paiement associe</p>
                                    @endif
                                </div>

                                @if($sub->payment_reference)
                                    <div class="detail-section">
                                        <h4>Reference paiement</h4>
                                        <div class="detail-ref">{{ $sub->payment_reference }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById('modal-' + id).classList.add('visible');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById('modal-' + id).classList.remove('visible');
    document.body.style.overflow = '';
}
</script>

@endsection

<style>
.cell-name {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    color: #fff;
}

.name-link {
    background: none;
    border: none;
    color: #fff;
    font-weight: 600;
    font-size: 13px;
    font-family: inherit;
    cursor: pointer;
    padding: 0;
    text-decoration: none;
    transition: color 0.15s ease;
}

.name-link:hover {
    color: var(--red);
}

.avatar {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: linear-gradient(135deg, var(--red), var(--red-dark));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    flex-shrink: 0;
    box-shadow: 0 2px 8px var(--red-glow);
}

.cell-email { color: #60a5fa; }
.cell-dim { color: var(--text-dim); }
.cell-date { color: var(--text-dim); font-size: 12px; white-space: nowrap; }

.tags { display: flex; gap: 4px; flex-wrap: wrap; }

.tag {
    display: inline-block;
    background: rgba(255,255,255,0.04);
    color: var(--text-muted);
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 500;
    border: 1px solid rgba(255,255,255,0.05);
}

.tag-muted { opacity: 0.4; }
.tag-more { background: rgba(229,9,20,0.1); color: var(--red); border-color: rgba(229,9,20,0.15); }

.dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    display: inline-block;
    margin-right: 6px;
    vertical-align: middle;
}

.dot-green { background: #10b981; box-shadow: 0 0 6px rgba(16,185,129,0.4); }
.dot-amber { background: #f59e0b; box-shadow: 0 0 6px rgba(245,158,11,0.4); }

.label {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    vertical-align: middle;
}

.label-green { background: rgba(16,185,129,0.1); color: #34d399; }
.label-amber { background: rgba(245,158,11,0.1); color: #fbbf24; }
.label-red { background: rgba(229,9,20,0.1); color: var(--red); }
.label-blue { background: rgba(59,130,246,0.1); color: #60a5fa; }
.label-purple { background: rgba(139,92,246,0.1); color: #a78bfa; }

.cell-actions {
    display: flex;
    gap: 4px;
    flex-wrap: wrap;
}

.inline-form { display: inline; }

.btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    white-space: nowrap;
}

.btn:disabled { opacity: 0.2; cursor: not-allowed; pointer-events: none; }
.btn-sm { padding: 5px 10px; font-size: 11px; }

.btn-success { background: rgba(16,185,129,0.1); color: #34d399; border: 1px solid rgba(16,185,129,0.15); }
.btn-success:hover:not(:disabled) { background: rgba(16,185,129,0.2); box-shadow: 0 0 20px rgba(16,185,129,0.1); }

.btn-danger { background: rgba(229,9,20,0.1); color: var(--red); border: 1px solid rgba(229,9,20,0.15); }
.btn-danger:hover:not(:disabled) { background: rgba(229,9,20,0.2); box-shadow: 0 0 20px rgba(229,9,20,0.1); }

.btn-ghost { background: rgba(255,255,255,0.04); color: var(--text-muted); border: 1px solid rgba(255,255,255,0.06); }
.btn-ghost:hover:not(:disabled) { background: rgba(255,255,255,0.08); color: var(--text); }

/* MODAL */
.modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.7);
    backdrop-filter: blur(4px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s ease;
}

.modal-overlay.visible {
    opacity: 1;
    pointer-events: all;
}

.modal-card {
    background: linear-gradient(145deg, rgba(20,20,20,0.99), rgba(10,10,10,0.99));
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    width: 100%;
    max-width: 640px;
    max-height: 85vh;
    overflow-y: auto;
    box-shadow: 0 25px 60px rgba(0,0,0,0.8);
}

.modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

.modal-header h3 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #fff;
}

.modal-close {
    background: none;
    border: none;
    color: var(--text-dim);
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: all 0.15s ease;
}

.modal-close:hover {
    color: #fff;
    background: rgba(255,255,255,0.06);
}

.modal-body {
    padding: 20px 24px 24px;
}

.detail-section {
    margin-bottom: 24px;
}

.detail-section:last-child {
    margin-bottom: 0;
}

.detail-section h4 {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: var(--text-dim);
    margin: 0 0 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.detail-label {
    font-size: 11px;
    color: var(--text-dim);
    font-weight: 500;
}

.detail-value {
    font-size: 13px;
    color: #fff;
    font-weight: 500;
}

.no-payment {
    color: var(--text-dim);
    font-size: 13px;
    font-style: italic;
    margin: 0;
}

.detail-ref {
    font-family: monospace;
    font-size: 13px;
    color: #fbbf24;
    background: rgba(255,255,255,0.03);
    padding: 8px 12px;
    border-radius: 6px;
    border: 1px solid rgba(255,255,255,0.05);
}

@media (max-width: 600px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }
    .modal-card {
        max-height: 90vh;
    }
}
</style>
