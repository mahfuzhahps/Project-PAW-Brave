<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = [
            [
                'title' => 'Berpikir ala Data Scientist',
                'category' => 'Seminar',
                'organizer' => 'FILKOM UB',
                'date' => '1 Desember 2026',
                'status' => 'Pending'
            ]

        ];
        
        return view('admin.events.index', [
            'events' => $events
        ]);
    }
}
