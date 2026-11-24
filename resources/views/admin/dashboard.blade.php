@extends('admin.layouts.app')

@section('title', 'Dashboard Admin | BRAVE')

@section('content')
    <div class="admin-page-heading">
        <h1>Dashboard</h1>
        <p>Ringkasan status dan pengajuan yang perlu diperiksa.</p>
    </div>

    <section class="admin-summary" aria-label="Ringkasan status pengajuan">
        <div class="summary-art" aria-hidden="true">
            <span></span><span></span><span></span>
        </div>

        <div class="summary-pending">
            <span class="summary-icon summary-icon-pending">
                @include('admin.partials.icon', ['name' => 'clock'])
            </span>
            <div class="summary-pending-body">
                <h2>Pending</h2>
                <div class="summary-pending-total">
                    <strong>{{ $counts['Pending'] }}</strong>
                    <span>Menunggu<br>pemeriksaan</span>
                </div>
            </div>
            <span class="summary-gold-dot" aria-hidden="true"></span>
        </div>

        <div class="summary-secondary">
            <div class="summary-status-title">
                <span class="summary-icon summary-icon-approved">
                    @include('admin.partials.icon', ['name' => 'check'])
                </span>
                <h2>Approved</h2>
            </div>
            <div class="summary-secondary-total">
                <strong>{{ $counts['Approved'] }}</strong>
                <p>Disetujui untuk dipublikasikan</p>
            </div>
        </div>

        <div class="summary-secondary summary-rejected">
            <div class="summary-status-title">
                <span class="summary-icon summary-icon-rejected">
                    @include('admin.partials.icon', ['name' => 'close'])
                </span>
                <h2>Rejected</h2>
            </div>
            <div class="summary-secondary-total">
                <strong>{{ $counts['Rejected'] }}</strong>
                <p>Pengajuan ditolak</p>
            </div>
        </div>
    </section>

    <section class="admin-pending-section" aria-labelledby="pending-title">
        <div class="admin-section-heading">
            <h2 id="pending-title">Menunggu pemeriksaan</h2>
            <button class="admin-button admin-button-primary admin-open-events" type="button" disabled>
                @include('admin.partials.icon', ['name' => 'arrow'])
                <span>Buka Kelola Event</span>
            </button>
        </div>

        <div class="admin-table-card">
            <table class="admin-event-table">
                <caption class="admin-visually-hidden">Daftar event yang menunggu pemeriksaan Admin</caption>
                <colgroup>
                    <col class="column-event">
                    <col class="column-organizer">
                    <col class="column-date">
                    <col class="column-status">
                    <col class="column-action">
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col">Judul event</th>
                        <th scope="col">Penyelenggara</th>
                        <th scope="col">Tanggal event</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendingEvents as $event)
                        <tr>
                            <td>
                                <div class="event-title-cell">
                                    <span class="event-category-icon event-category-icon-{{ $event['tone'] }}">
                                        @include('admin.partials.icon', ['name' => $event['icon']])
                                    </span>
                                    <div>
                                        <span class="event-title">{{ $event['title'] }}</span>
                                        <span class="event-category">{{ $event['category'] }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="event-organizer">{{ $event['organizer'] }}</td>
                            <td class="event-date">{{ \Carbon\Carbon::parse($event['date'])->locale('id')->translatedFormat('j F Y') }}</td>
                            <td>
                                <span class="admin-status admin-status-pending">
                                    <span aria-hidden="true"></span>
                                    Pending
                                </span>
                            </td>
                            <td>
                                <button class="admin-button admin-button-detail" type="button" disabled aria-label="Detail {{ $event['title'] }}">
                                    @include('admin.partials.icon', ['name' => 'arrow'])
                                    <span>Detail</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="admin-table-empty">Belum ada pengajuan yang menunggu pemeriksaan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
