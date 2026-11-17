<?php

namespace App\Http\Controllers;

use App\Models\PenjualanSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PenjualanSampahController extends Controller
{
    // Menampilkan rekapitulasi penjualan untuk masyarakat
    public function indexMasyarakat()
    {
        $penjualan = PenjualanSampah::with('admin')
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalBerat = $penjualan->sum('total_berat');
        $totalNominal = $penjualan->sum('total_nominal');
        $jumlahTransaksi = $penjualan->count();

        return view('masyarakat.penjualan.index', compact(
            'penjualan',
            'totalBerat',
            'totalNominal',
            'jumlahTransaksi'
        ));
    }


    // Menampilkan daftar penjualan sampah
    public function index()
    {
        $penjualan = PenjualanSampah::with('admin')
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalBerat = $penjualan->sum('total_berat');
        $totalNominal = $penjualan->sum('total_nominal');
        $jumlahTransaksi = $penjualan->count();

        return view('admin.penjualan.index', compact(
            'penjualan',
            'totalBerat',
            'totalNominal',
            'jumlahTransaksi'
        ));
    }

    // Menampilkan formulir tambah penjualan
    public function create()
    {
        return view('admin.penjualan.create');
    }

    // Menyimpan data penjualan ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'total_berat' => 'required|numeric|gt:0',
            'total_nominal' => 'required|numeric|gt:0',
        ]);

        $penjualan = new PenjualanSampah();

        $penjualan->tanggal = $validated['tanggal'];
        $penjualan->total_berat = $validated['total_berat'];
        $penjualan->total_nominal = $validated['total_nominal'];
        $penjualan->created_by = Auth::id();

        $penjualan->save();

        return redirect()
            ->route('admin.penjualan.index')
            ->with('success', 'Data penjualan berhasil disimpan.');
    }
}
