<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Pratinjau lokal dengan data contoh, sebelum integrasi database dan auth.
        abort_unless(app()->environment('local'), 404);

        $pendingEvents = [
            [
                'title' => 'Workshop UI/UX Dasar',
                'category' => 'Workshop',
                'organizer' => 'BEM FILKOM UB',
                'date' => '12 Des 2026',
                'icon' => 'note',
                'tone' => 'blue',
            ],
            [
                'title' => 'Bazar Karya Mahasiswa',
                'category' => 'Bazar',
                'organizer' => 'FEB UB',
                'date' => '16 Des 2026',
                'icon' => 'picture',
                'tone' => 'gold',
            ],
            [
                'title' => 'Turnamen Futsal UB',
                'category' => 'Olahraga',
                'organizer' => 'UKM Olahraga',
                'date' => '19 Des 2026',
                'icon' => 'calendar',
                'tone' => 'green',
            ],
        ];

        return view('admin.dashboard', [
            'counts' => [
                'Pending' => count($pendingEvents),
                'Approved' => 8,
                'Rejected' => 2,
            ],
            'pendingEvents' => $pendingEvents,
        ]);
    }
}
