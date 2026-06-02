@extends('admin.layouts.admin')

@section('content')

<h2 class="page-title">📋 Inscriptions</h2>

<table class="table-admin">

    <thead>
        <tr>
            <th>Nom complet</th>
            <th>Email</th>
            <th>Pays</th>
            <th>Actor ID</th>
            <th>Catégories</th>
            <th>Statut</th>
        </tr>
    </thead>

    <tbody>

        @foreach($subscriptions as $sub)

            <tr>

                <!-- NOM -->
                <td class="name">
                    {{ $sub->fullname }}
                </td>

                <!-- EMAIL -->
                <td class="email">
                    {{ $sub->email }}
                </td>

                <!-- PAYS -->
                <td class="country">
                    {{ $sub->country }}
                </td>

                <!-- ACTOR ID -->
                <td class="actor">
                    #{{ $sub->actor_id }}
                </td>

                <!-- CATEGORIES (ROBUSTE FIX) -->
                <td class="categories">

                    @php
                        $categories = is_array($sub->categories)
                            ? $sub->categories
                            : json_decode($sub->categories, true);
                    @endphp

                    @if(!empty($categories))

                        @foreach($categories as $category)

                            <span class="category-badge">
                                {{ $category }}
                            </span>

                        @endforeach

                    @else

                        -

                    @endif

                </td>

                <!-- STATUS -->
                <td>

                    <span class="status status-{{ strtolower($sub->status) }}">

                        @if($sub->status == 'pending')

                            ⏳ EN ATTENTE

                        @elseif($sub->status == 'sent')

                            📤 ENVOYÉ

                        @elseif($sub->status == 'approved')

                            ✅ APPROUVÉ

                        @elseif($sub->status == 'rejected')

                            ❌ REJETÉ

                        @else

                            📨 REÇU

                        @endif

                    </span>

                </td>

            </tr>

        @endforeach

    </tbody>

</table>

@endsection


<!-- CSS EN BAS -->
<style>

    body {
        background: #f1f5f9;
    }

    /* TITRE */
    .page-title {
        font-size: 26px;
        font-weight: bold;
        color: #0f172a;
        margin-bottom: 20px;
    }

    /* TABLE */
    .table-admin {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .table-admin thead {
        background: linear-gradient(90deg, #0f172a, #1e293b);
        color: #fff;
    }

    .table-admin th {
        padding: 14px;
        text-align: left;
        font-size: 14px;
    }

    .table-admin td {
        padding: 14px;
        border-bottom: 1px solid #e5e7eb;
        font-size: 14px;
        vertical-align: top;
    }

    .table-admin tr:nth-child(even) {
        background: #f8fafc;
    }

    .table-admin tr:hover {
        background: #e0f2fe;
        transition: 0.2s;
    }

    /* COLONNES */
    .name {
        font-weight: 600;
        color: #0f172a;
    }

    .email {
        color: #2563eb;
    }

    .country {
        color: #64748b;
    }

    .actor {
        color: #ea580c;
        font-weight: bold;
    }

    /* CATEGORIES */
    .category-badge {
        display: inline-block;
        background: #dbeafe;
        color: #1d4ed8;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        margin: 2px;
        font-weight: 500;
    }

    /* STATUS BADGES */
    .status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        color: #fff;
        text-transform: uppercase;
        display: inline-block;
    }

    .status-pending {
        background: #f59e0b;
    }

    .status-approved {
        background: #16a34a;
    }

    .status-rejected {
        background: #dc2626;
    }

    .status-sent {
        background: #2563eb;
    }

    .status-received {
        background: #7c3aed;
    }

</style>