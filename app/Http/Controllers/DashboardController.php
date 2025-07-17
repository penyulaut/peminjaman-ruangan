<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan kalender peminjaman ruangan
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.beranda.index', [
            'title' => 'Beranda',
            'roomCount' => room::count(),
            'userCount' => User::count(),
            'rentCount' => rent::count(),
            'majorCount' => User::select('jurusan')->distinct()->count(),
        ]);
    }

    /**
     * Mengambil data peminjaman ruangan untuk ditampilkan di kalender
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvents()
    {
        // Ambil data peminjaman ruangan dengan relasi ke tabel Room
        $rentals = Rent::with('room')->get();

        $events = [];

        foreach ($rentals as $rental) {
            $events[] = [
                'title' => $rental->room->nama . ' - ' . $rental->peminjam,
                'start' => $rental->tanggal_mulai,
                'end' => $rental->tanggal_selesai,
                'color' => '#3788d8', // Warna event
            ];
        }

        return response()->json($events);
    }
}
