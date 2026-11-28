<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\AdminPreviewEvents;

class EventController extends Controller
{
    public function index(Request $request)
    {

    $events = AdminPreviewEvents::all();

        $selectedStatus = $request->query('status', 'pending');

        if (!in_array($selectedStatus, ['all', 'pending', 'approved', 'rejected'], true)) {
            $selectedStatus = 'pending';
        }

        $filteredEvents = [];

        foreach ($events as $event) {
            if (
                $selectedStatus === 'all' ||
                strtolower($event['status']) === $selectedStatus
            ) {
                $filteredEvents[] = $event;
            }
        }

        usort($filteredEvents, function ($a, $b) {
            return strcmp($a['date'], $b['date']);
        });
        
        return view('admin.events.index', [
            'events' => $filteredEvents,
            'selectedStatus' => $selectedStatus,
        ]);
    }

    public function show(int $id)
    {
        $selectedEvent = null;

        foreach (AdminPreviewEvents::all() as $event) {
            if ($event['id'] === $id) {
                $selectedEvent = $event;
                break;
            }
        }

        abort_if($selectedEvent === null, 404);

        return view('admin.events.show', [
            'event' => $selectedEvent,
        ]);
    }
}
