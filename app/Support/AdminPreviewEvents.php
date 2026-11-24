<?php

namespace App\Support;

class AdminPreviewEvents
{
    public static function all(): array
    {
        $events = [
            [
                'title' => 'Berpikir ala Data Scientist',
                'category' => 'Seminar',
                'organizer' => 'FILKOM UB',
                'date' => '2026-12-01',
                'status' => 'Pending',
                'format' => 'hybrid',
                'fee_type' => 'gratis',
                'price_amount' => 0,
            ],
            [
                'title' => 'Workshop Machine Learning',
                'category' => 'Workshop',
                'organizer' => 'GDGOC UB',
                'date' => '2027-01-15',
                'status' => 'Approved',
                'format' => 'daring',
                'fee_type' => 'berbayar',
                'price_amount' => 80000,
            ],
            [
                'title' => 'Hackathon 2027',
                'category' => 'Lomba',
                'organizer' => 'Universitas Brawijaya',
                'date' => '2027-02-20',
                'status' => 'Rejected',
                'format' => 'luring',
                'fee_type' => 'gratis',
                'price_amount' => 0,
            ],
            [
                'title' => 'Homeband Festival',
                'category' => 'Musik',
                'organizer' => 'Homeband UB',
                'date' => '2027-02-15',
                'status' => 'Pending',
                'format' => 'luring',
                'fee_type' => 'gratis',
                'price_amount' => 0,
            ],
            [
                'title' => 'Ruang Hati: Menjaga Iman di Tengah Kesibukan Kuliah',
                'category' => 'Keagamaan',
                'organizer' => 'Masjid Raden Patah UB',
                'date' => '2026-12-05',
                'status' => 'Approved',
                'format' => 'luring',
                'fee_type' => 'gratis',
                'price_amount' => 0,
            ],
            [
                'title' => 'Dies Natalis UB ke-64',
                'category' => 'Bazar',
                'organizer' => 'Universitas Brawijaya',
                'date' => '2027-01-05',
                'status' => 'Pending',
                'format' => 'luring',
                'fee_type' => 'gratis',
                'price_amount' => 0,
            ],
            [
                'title' => 'Fun Climbing',
                'category' => 'Olahraga',
                'organizer' => 'Impala UB',
                'date' => '2027-03-10',
                'status' => 'Approved',
                'format' => 'luring',
                'fee_type' => 'berbayar',
                'price_amount' => 35000,
            ],
        ];
        
        return $events;
    }
}