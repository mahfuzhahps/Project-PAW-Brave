@extends('admin.layouts.app')

@section('title', 'Kelola Event | BRAVE')

@section('content')
    <div class="admin-page-heading">
        <h1>Kelola Event</h1>
        <p>Periksa pengajuan event sebelum dipublikasikan.</p>
    </div>
    <form
    action="{{ route('preview.admin.events.index') }}"
    method="GET"
    class="admin-status-filters"
    >
        @foreach ([
            'all' => 'Semua Status',
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ] as $value => $label)
            <button
                type="submit"
                name="status"
                value="{{ $value }}"
                class="admin-button {{ $selectedStatus === $value ? 'admin-button-primary' : 'admin-button-detail' }}"
            >
                {{ $label }}
            </button>
        @endforeach
    </form>
    <div class="admin-table-card">
        <table class="admin-event-table">
            <thead>
                <tr>
                    <th scope="col">Judul Event</th>
                    <th scope="col">Penyelenggara</th>
                    <th scope="col">Tanggal Event</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tindakan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td>
                            <span class="event-title">
                                {{ $event['title'] }}
                            </span>
                            <span class="event-category">
                                {{ $event['category'] }}
                            </span>
                        </td>
                        <td class="event-organizer">
                            {{ $event['organizer'] }}
                        </td>
                        <td class="event-date">
                            {{ \Carbon\Carbon::parse($event['date'])->locale('id')->translatedFormat('j F Y') }}
                        </td>
                        <td>
                            <span class="admin-status admin-status-{{ strtolower($event['status']) }}">
                                <span aria-hidden="true"></span>
                                {{ $event['status'] }}
                            </span>
                        </td>
                        <td>
                            <button class="admin-button admin-button-detail"
                                    type="button" disabled>
                                Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="admin-table-empty">
                            Belum ada event pada status ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

