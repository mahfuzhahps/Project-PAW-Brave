@extends('admin.layouts.app')

@section('title', 'Detail Pengajuan | BRAVE')

@section('content')
    @php
        $formatTanggal = static fn ($tanggal) =>
            \Carbon\Carbon::parse($tanggal)
                ->locale('id')
                ->translatedFormat('j F Y');
    @endphp

    <a class="admin-detail-back"
       href="{{ route('preview.admin.events.index') }}">
        ← Kembali ke Kelola Event
    </a>

    <div class="admin-detail-heading">
        <div class="admin-page-heading">
            <h1>{{ $event['title'] }}</h1>
            <p>Detail pengajuan event.</p>
        </div>

        <span class="admin-status admin-status-{{ strtolower($event['status']) }}">
            <span aria-hidden="true"></span>
            {{ $event['status'] }}
        </span>
    </div>

    <section class="admin-table-card admin-detail-card">
        <dl class="admin-detail-grid">
            <div>
                <dt>Penyelenggara</dt>
                <dd>{{ $event['organizer'] }}</dd>
            </div>

            <div>
                <dt>Kategori</dt>
                <dd>{{ $event['category'] }}</dd>
            </div>

            <div>
                <dt>{{ $event['date_label'] ?? 'Tanggal event' }}</dt>

                <dd>
                    @if (!empty($event['sessions']))
                        @foreach ($event['sessions'] as $session)
                            <div>
                                {{ $formatTanggal($session['date']) }}
                                · {{ $session['time'] }}–{{ $session['end_time'] }} WIB
                            </div>
                        @endforeach

                    @elseif (($event['end_date'] ?? $event['date']) !== $event['date'])
                        {{ $formatTanggal($event['date']) }}
                        –
                        {{ $formatTanggal($event['end_date']) }}

                    @else
                        {{ $formatTanggal($event['date']) }}
                        · {{ $event['time'] }}–{{ $event['end_time'] }} WIB
                    @endif
                </dd>

                @if (!empty($event['schedule_note']))
                    <dd>{{ $event['schedule_note'] }}</dd>
                @endif
            </div>

            <div>
                <dt>Format pelaksanaan</dt>
                <dd>{{ ucfirst($event['format']) }}</dd>
            </div>

            <div>
                <dt>Biaya</dt>
                <dd>
                    @if ($event['fee_type'] === 'gratis')
                        Gratis
                    @else
                        Rp{{ number_format($event['price_amount'], 0, ',', '.') }}
                    @endif
                </dd>
            </div>
        </dl>
    </section>
@endsection