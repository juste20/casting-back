@extends('admin.layouts.admin')

@section('title', 'Castings')

@section('content')

<div class="page-header">
    <h1 class="page-title">Castings recus</h1>
    <span class="page-count">{{ $castings->count() }} casting(s)</span>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-card">
    <div class="table-card-header">
        <h3>Liste des castings</h3>
    </div>
    <div class="table-scroll">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Promoteur</th>
                    <th>Contact</th>
                    <th>Pays</th>
                    <th>Periode</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($castings as $casting)
                    <tr>
                        <td class="cell-name">
                            <button class="name-link" onclick="openModal({{ $casting->id }})">{{ $casting->title }}</button>
                        </td>
                        <td class="cell-email">{{ $casting->promoter_email }}</td>
                        <td class="cell-dim">{{ $casting->promoter_phone ?? '-' }}</td>
                        <td class="cell-dim">{{ $casting->country }}</td>
                        <td class="cell-date">
                            @if($casting->start_date && $casting->end_date)
                                {{ \Carbon\Carbon::parse($casting->start_date)->format('d/m/Y') }}
                                - {{ \Carbon\Carbon::parse($casting->end_date)->format('d/m/Y') }}
                            @else
                                {{ $casting->date }}
                            @endif
                        </td>
                        <td>
                            <span class="label label-{{ $casting->status }}">
                                @switch($casting->status)
                                    @case('pending') En attente @break
                                    @case('validated') Approuve @break
                                    @case('rejected') Rejete @break
                                    @case('archived') Archive @break
                                    @default {{ $casting->status }}
                                @endswitch
                            </span>
                        </td>
                        <td class="cell-actions">
                            <form action="{{ route('admin.castings.validate', $casting->id) }}" method="POST" class="inline-form">
                                @csrf
                                <button class="btn btn-sm btn-success"
                                    {{ $casting->status !== 'pending' ? 'disabled' : '' }}
                                    title="Valider le casting">Valider</button>
                            </form>
                            <form action="{{ route('admin.castings.reject', $casting->id) }}" method="POST" class="inline-form">
                                @csrf
                                <input type="text" name="reason" placeholder="Motif (optionnel)" class="reason-input">
                                <button class="btn btn-sm btn-danger"
                                    {{ $casting->status !== 'pending' ? 'disabled' : '' }}
                                    title="Rejeter le casting">Rejeter</button>
                            </form>
                        </td>
                    </tr>

                    {{-- MODAL --}}
                    <div id="modal-{{ $casting->id }}" class="modal-overlay" onclick="closeModal({{ $casting->id }})">
                        <div class="modal-card" onclick="event.stopPropagation()">
                            <div class="modal-header">
                                <h3>{{ $casting->title }}</h3>
                                <button class="modal-close" onclick="closeModal({{ $casting->id }})">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="detail-section">
                                    <h4>Informations du promoteur</h4>
                                    <div class="detail-grid">
                                        <div class="detail-item">
                                            <span class="detail-label">Email</span>
                                            <span class="detail-value">{{ $casting->promoter_email }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Telephone</span>
                                            <span class="detail-value">{{ $casting->promoter_phone ?? '-' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="detail-section">
                                    <h4>Details du casting</h4>
                                    <div class="detail-grid">
                                        <div class="detail-item">
                                            <span class="detail-label">Titre</span>
                                            <span class="detail-value">{{ $casting->title }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Pays</span>
                                            <span class="detail-value">{{ $casting->country }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Debut</span>
                                            <span class="detail-value">{{ $casting->start_date ? \Carbon\Carbon::parse($casting->start_date)->format('d/m/Y') : $casting->date }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Fin</span>
                                            <span class="detail-value">{{ $casting->end_date ? \Carbon\Carbon::parse($casting->end_date)->format('d/m/Y') : '-' }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Statut</span>
                                            <span class="detail-value">
                                                <span class="label label-{{ $casting->status }}">
                                                    {{ $casting->status }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if($casting->description)
                                    <div class="detail-section">
                                        <h4>Description</h4>
                                        <p class="detail-desc">{{ $casting->description }}</p>
                                    </div>
                                @endif

                                @if($casting->poster)
                                    <div class="detail-section">
                                        <h4>Affiche</h4>
                                        <img src="{{ asset('storage/' . $casting->poster) }}" class="detail-poster">
                                    </div>
                                @endif

                                @if($casting->rejection_reason)
                                    <div class="detail-section">
                                        <h4>Motif du rejet</h4>
                                        <p class="detail-reason">{{ $casting->rejection_reason }}</p>
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
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
}

.page-title {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    letter-spacing: -0.3px;
}

.page-count {
    font-size: 12px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.06);
    color: #808080;
    padding: 4px 14px;
    border-radius: 20px;
    font-weight: 500;
}

.alert {
    padding: 12px 16px;
    border-radius: 8px;
    margin-bottom: 16px;
    font-size: 13px;
    font-weight: 500;
}
.alert-success {
    background: rgba(16,185,129,0.1);
    color: #34d399;
    border: 1px solid rgba(16,185,129,0.2);
}

.table-card {
    background: linear-gradient(145deg, rgba(20,20,20,0.95), rgba(10,10,10,0.98));
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 16px;
    overflow: hidden;
}

.table-card-header {
    padding: 16px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.06);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.table-card-header h3 {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
}

.table-scroll { overflow-x: auto; }

.admin-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

.admin-table thead { background: rgba(255,255,255,0.02); }
.admin-table th {
    padding: 12px 16px;
    text-align: left;
    font-weight: 600;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #808080;
    white-space: nowrap;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}

.admin-table td {
    padding: 12px 16px;
    border-bottom: 1px solid rgba(255,255,255,0.03);
    vertical-align: middle;
    color: #9ca3af;
}

.admin-table tbody tr:hover { background: rgba(255,255,255,0.02); }
.admin-table tbody tr:last-child td { border-bottom: none; }

.cell-name { color: #fff; font-weight: 600; }
.cell-email { color: #60a5fa; }
.cell-dim { color: #808080; }
.cell-date { color: #808080; font-size: 12px; }

.name-link {
    background: none;
    border: none;
    color: #fff;
    font-weight: 600;
    font-size: 13px;
    font-family: inherit;
    cursor: pointer;
    padding: 0;
    transition: color 0.15s ease;
}

.name-link:hover { color: var(--red); }

.label {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
}

.label-pending { background: rgba(245,158,11,0.1); color: #fbbf24; }
.label-validated { background: rgba(16,185,129,0.1); color: #34d399; }
.label-rejected { background: rgba(229,9,20,0.1); color: var(--red); }
.label-archived { background: rgba(255,255,255,0.05); color: #808080; }

.cell-actions {
    display: flex;
    gap: 4px;
    flex-wrap: wrap;
    align-items: center;
}

.inline-form { display: inline-flex; align-items: center; gap: 4px; }

.reason-input {
    width: 120px;
    padding: 5px 8px;
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 6px;
    background: rgba(255,255,255,0.03);
    color: #fff;
    font-size: 11px;
    font-family: inherit;
    outline: none;
    transition: border-color 0.15s ease;
}

.reason-input:focus {
    border-color: rgba(229,9,20,0.3);
}

.reason-input::placeholder {
    color: #808080;
}

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

.modal-overlay.visible { opacity: 1; pointer-events: all; }

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
    color: #808080;
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: all 0.15s ease;
}
.modal-close:hover { color: #fff; background: rgba(255,255,255,0.06); }

.modal-body { padding: 20px 24px 24px; }

.detail-section { margin-bottom: 24px; }
.detail-section:last-child { margin-bottom: 0; }

.detail-section h4 {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #808080;
    margin: 0 0 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

.detail-item {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.detail-label { font-size: 11px; color: #808080; font-weight: 500; }
.detail-value { font-size: 13px; color: #fff; font-weight: 500; }
.detail-desc { font-size: 13px; color: #9ca3af; line-height: 1.6; margin: 0; }
.detail-poster { width: 100%; max-height: 300px; object-fit: cover; border-radius: 8px; }
.detail-reason { font-size: 13px; color: var(--red); margin: 0; }

@media (max-width: 600px) {
    .detail-grid { grid-template-columns: 1fr; }
}
</style>
