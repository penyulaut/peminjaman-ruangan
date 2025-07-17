<?php

namespace App\Http\Controllers;

use App\Models\Rent; // <- Ini pakai Rent, bukan Event
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('dashboard.calendar.index', [ // Ubah sesuai path view kamu
            'title' => 'Kalender Event Saya',
        ]);
    }

    public function listEvent(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        $events = Rent::whereDate('time_start_use', '>=', $start)
            ->whereDate('time_end_use', '<=', $end)
            ->where('status', 'dipinjam')
            ->get()
            ->map(function ($rent) {
                return [
                    'id' => $rent->id,
                    'title' => $rent->room->nama,
                    'start' => $rent->time_start_use,
                    'end' => $rent->time_end_use, // Tidak perlu tambah 1 hari kecuali memang mau
                    'category' => $rent->category,
                    'className' => ['bg-' . $rent->category] // FullCalendar bisa pakai class CSS custom
                ];
            });

        return response()->json($events);
    }
}
