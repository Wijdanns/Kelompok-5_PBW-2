<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index()
    {
        // Mengambil variabel header dari config untuk ditampilkan di view
        $layanan_header = config('shipping.header');
        
        return view('shipping.index', compact('layanan_header'));
    }

    public function calculate(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'jarak' => 'required|numeric|min:0.1',
            'prioritas' => 'required|in:reguler,express',
        ]);

        // Mengambil nilai variabel dasar dari config
        $layanan_header = config('shipping.header');
        $tarif_per_km = config('shipping.tarif_per_km');
        $biaya_penanganan = config('shipping.biaya_penanganan');

        // Menangkap input
        $jarak = $request->input('jarak');
        $prioritas = $request->input('prioritas');

        $ongkir_dasar = $jarak * $tarif_per_km;

        if ($prioritas === 'express') {
            $total_ongkir = ($ongkir_dasar * 1.5) + $biaya_penanganan;
            $tipe_layanan = "Express (Pengantaran Instan < 2 Jam)";
        } else {
            $total_ongkir = $ongkir_dasar + $biaya_penanganan;
            $tipe_layanan = "Reguler (Sesuai Urutan Rute)";
        }

        // Mengembalikan ke view 
        return view('shipping.index', compact(
            'layanan_header', 
            'total_ongkir', 
            'tipe_layanan', 
            'jarak', 
            'prioritas'
        ));
    }
}