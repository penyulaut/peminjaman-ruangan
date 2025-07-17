<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfExportController extends Controller
{
    public function index(){
        $user = Auth::user();

        // Filter berdasarkan role
        if ($user->role->id == 1) {
            $rents = Rent::with(['room', 'user'])->get();
        } else {
            $rents = Rent::with(['room', 'user'])->where('user_id', $user->id)->get();
        }

        return view('rent', ['rents' => $rents]);
    }

    public function exportPdf(){ 
        $user = Auth::user();

        // Filter berdasarkan role
        if ($user->role->id == 1) {
            $rents = Rent::with(['room', 'user'])->get();
        } else {
            $rents = Rent::with(['room', 'user'])->where('user_id', $user->id)->get();
        }

        $pdf = Pdf::loadView('dashboard.rents.export_pdf', ['rents' => $rents]);
        return $pdf->download('invoice.pdf');
    }
}
