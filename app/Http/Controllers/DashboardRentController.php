<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Exports\RentsExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardRentController extends Controller
{
    /**
     * Tampilkan semua data peminjaman untuk admin dan user.
     */
    public function index()
    {
        return view('dashboard.rents.index', [
            'adminRents' => Rent::with(['room', 'user'])->latest()->get(),
            'userRents' => Rent::with(['room'])->where('user_id', auth()->id())->get(),
            'rooms' => Room::all(),
            'title' => "Peminjaman",
            'pendingCount' => Rent::where('status', 'pending')->count(),
            'disetujuiCount' => Rent::where('status', 'dipinjam')->count(),
            'ditolakCount' => Rent::where('status', 'ditolak')->count(),
        ]);
    }

    /**
     * Simpan data peminjaman baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'time_start_use' => 'required|date',
            'time_end_use' => 'required|date|after:time_start_use',
            'purpose' => 'required|max:250',
        ]);

        $validatedData['user_id'] = auth()->id();
        $validatedData['transaction_start'] = now();
        $validatedData['transaction_end'] = null;
        $validatedData['status'] = 'pending';

        Rent::create($validatedData);

        return redirect()->route('rents.index')->with('rentSuccess', 'Peminjaman berhasil diajukan. Harap tunggu konfirmasi admin.');
    }

    /**
     * Hapus data peminjaman.
     */
    public function destroy(Rent $rent)
    {
        $rent->delete();
        return redirect()->route('rents.index')->with('deleteRent', 'Data peminjaman berhasil dihapus.');
    }

    /**
     * Akhiri transaksi peminjaman.
     */
    public function endTransaction($id)
    {
        Rent::where('id', $id)->update([
            'transaction_end' => now(),
            'status' => 'selesai',
        ]);

        return redirect()->route('rents.index')->with('transactionEnded', 'Transaksi peminjaman telah diselesaikan.');
    }

    public function approve($id)
    {
        $rent = Rent::findOrFail($id);
        if (in_array($rent->status, ['pending', 'ditolak'])) {
            $rent->status = 'dipinjam';
            $rent->transaction_start = now();
            $rent->save();

            return redirect()->route('rents.index')->with('rentSuccess', 'Peminjaman berhasil disetujui!');
        }

        return redirect()->route('rents.index')->with('rentError', 'Status tidak valid untuk disetujui.');
    }


    public function reject($id)
    {
        $rent = Rent::findOrFail($id);
        if ($rent->status === 'pending') {
            $rent->status = 'ditolak';
            $rent->transaction_end = now();
            $rent->save();

            return redirect()->route('rents.index')->with('rentRejected', 'Peminjaman berhasil ditolak.');
        }   

        return redirect()->route('rents.index')->with('deleteRent', 'Peminjaman tidak dapat ditolak karena tidak dalam status pending.');
    }

    public function export() 
    {
        if (auth()->user()->role_id == 1) {
            $rents = Rent::with(['user', 'room'])->get();
        } else {
            $rents = Rent::with(['user', 'room'])
                        ->where('user_id', auth()->id())
                        ->get();
        }

        return Excel::download(new RentsExport, 'data-peminjaman.xlsx');
    }

}
