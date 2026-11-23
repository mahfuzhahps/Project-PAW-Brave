@extends('admin.layouts.app')

@section('title', 'Kelola Event | BRAVE')

@section('content')
    <div class="admin-page-heading">
        <h1>Kelola Event</h1>
        <p>Periksa pengajuan event sebelum dipublikasikan.</p>
    </div>
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
                @foreach ($events as $event)
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
                            {{ $event['date'] }}
                        </td>
                        <td>
                            <span class="admin-status admin-status-pending">
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
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

