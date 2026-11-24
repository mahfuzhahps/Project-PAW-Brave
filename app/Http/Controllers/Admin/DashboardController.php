<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\AdminPreviewEvents;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        abort_unless(app()->environment('local'), 404);

        $events = AdminPreviewEvents::all();

        $counts = [
            'Pending' => 0,
            'Approved' => 0,
            'Rejected' => 0,
        ];

        $pendingEvents = [];

        foreach ($events as $event) {
            $counts[$event['status']]++;

            if ($event['status'] === 'Pending') {
                $event['icon'] = match ($event['category']) {
                    'Bazar' => 'picture',
                    'Workshop' => 'note',
                    default => 'calendar',
                };

                $event['tone'] = match ($event['category']) {
                    'Bazar' => 'gold',
                    'Olahraga' => 'green',
                    default => 'blue',
                };

                $pendingEvents[] = $event;
            }
        }

        usort($pendingEvents, function ($a, $b) {
            return strcmp($a['date'], $b['date']);
        });

        return view('admin.dashboard', [
            'counts' => $counts,
            'pendingEvents' => $pendingEvents,
        ]);
    }
}