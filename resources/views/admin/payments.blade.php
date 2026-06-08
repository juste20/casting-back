@extends('admin.layouts.admin')

@section('title', 'Paiements')

@section('content')

<div class="page-header">
    <h1 class="page-title">Paiements</h1>
    <span class="page-count">{{ $payments->count() }} paiement(s)</span>
</div>

<div class="table-card">
    <div class="table-card-header">
        <h3>Historique des paiements</h3>
    </div>
    <div class="table-scroll">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Email</th>
                    <th>Montant</th>
                    <th>Methode</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td class="cell-ref">{{ $payment->reference }}</td>
                        <td class="cell-email">{{ $payment->email }}</td>
                        <td class="cell-amount">{{ number_format($payment->amount, 0, ',', ' ') }} FCFA</td>
                        <td class="cell-dim">{{ strtoupper($payment->method) }}</td>
                        <td>
                            @php $s = strtolower($payment->status); @endphp
                            @switch($s)
                                @case('pending')
                                    <span class="label label-amber">En attente</span>
                                    @break
                                @case('success')
                                    <span class="label label-green">Valide</span>
                                    @break
                                @case('failed')
                                    <span class="label label-red">Echoue</span>
                                    @break
                                @default
                                    <span class="label">{{ $payment->status }}</span>
                            @endswitch
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:40px;color:var(--text-dim);">
                            Aucun paiement trouve
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

<style>
.cell-ref { font-weight: 600; color: #fff; }
.cell-email { color: #60a5fa; }
.cell-amount { color: #34d399; font-weight: 600; }
.cell-dim { color: var(--text-dim); }

.label {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
}

.label-green { background: rgba(16,185,129,0.1); color: #34d399; }
.label-amber { background: rgba(245,158,11,0.1); color: #fbbf24; }
.label-red { background: rgba(229,9,20,0.1); color: var(--red); }
</style>
