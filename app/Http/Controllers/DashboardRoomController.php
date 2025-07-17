<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.rooms.index', [
            'title' => "Ruangan",
            'rooms' => Room::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Melakukan validasi input
        $validatedData = $request->validate([
            'kode' => 'required|max:4|unique:rooms',
            'nama' => 'required',
            'img'   => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'lantai' => 'required',
            'kapasitas' => 'required',
            'tipe' => 'required',
            'deskripsi' => 'required|max:250',
        ]);

        if ($request->hasFile('img')) {
            // Simpan file ke folder 'public/room-image' (otomatis ke storage/app/public)
            $validatedData['img'] = $request->file('img')->store('room-image', 'public');
        } else {
            $validatedData['img'] = 'room-image/roomdefault.jpg';
        }
    
        Room::create($validatedData);
        return redirect('/dashboard/rooms')->with('success', 'Ruangan berhasil dibuat!');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {        
        return view('dashboard.rooms.show', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        return json_encode($room);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $room = Room::findOrFail($id);
    $rules = [
        'nama' => 'required|max:100',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'lantai' => 'required',
        'kapasitas' => 'required|numeric',
        'tipe' => 'required',
        'deskripsi' => 'required|max:250',
    ];

    // Validasi unique hanya jika kode diubah
    if ($request->kode != $room->kode) {
        $rules['kode'] = 'required|max:4|unique:rooms,kode,' . $room->id;
    }

    $validatedData = $request->validate($rules);

    // Handle gambar hanya jika diupload
    if ($request->hasFile('img')) {
        // Hapus gambar lama jika bukan default
        if ($room->img && $room->img !== 'room-image/roomdefault.jpg') {
            Storage::delete('public/'.$room->img);
        }
        $validatedData['img'] = $request->file('img')->store('room-image', 'public');
    }

    // Update data
    $room->update($validatedData);

    return redirect('/dashboard/rooms')->with('roomSuccess', 'Data ruangan berhasil diubah');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->room()->delete();
        
        $room->delete();

        return redirect('/dashboard/rooms')->with('deleteRoom', 'Data ruangan dan peminjamannya berhasil dihapus');
    }
}
