<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RiwayatPerawatan;
use App\Models\Server;

class RiwayatPerawatanController extends Controller
{
    public function index()
    {
        // Ambil seluruh data untuk keperluan filter/pencarian dan ekspor di client-side
        $items = RiwayatPerawatan::with('server')
            ->orderBy('treatment_date', 'desc')
            ->get();

        return view('pages.admin.riwayatperawatan.index', compact('items'));
    }

    public function create()
    {
        $servers = Server::select('id','brand','model','serial_number')->orderBy('brand')->get();
        return view('pages.admin.riwayatperawatan.create', compact('servers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_server'      => 'required|exists:tb_server,id',
            'treatment_date' => 'required|date',
            'treatment_type' => 'required|string|max:100',
            'description'    => 'nullable|string|max:500',
            'cost'           => 'nullable|string|max:50',
            'long_warranty'  => 'nullable|string|max:50',
        ]);

        RiwayatPerawatan::create($validated);

        return redirect()->route('admin.riwayatperawatan.index')
            ->with('success', 'Jadwal perawatan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $item = RiwayatPerawatan::with('server')->findOrFail($id);
        return view('pages.admin.riwayatperawatan.show', compact('item'));
    }

    public function edit($id)
    {
        $item = RiwayatPerawatan::findOrFail($id);
        $servers = Server::select('id','brand','model','serial_number')->orderBy('brand')->get();
        return view('pages.admin.riwayatperawatan.edit', compact('item','servers'));
    }

    public function update(Request $request, $id)
    {
        $item = RiwayatPerawatan::findOrFail($id);
        $validated = $request->validate([
            'id_server'      => 'required|exists:tb_server,id',
            'treatment_date' => 'required|date',
            'treatment_type' => 'required|string|max:100',
            'description'    => 'nullable|string|max:500',
            'cost'           => 'nullable|string|max:50',
            'long_warranty'  => 'nullable|string|max:50',
        ]);

        $item->update($validated);

        return redirect()->route('admin.riwayatperawatan.index')
            ->with('success', 'Jadwal perawatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = RiwayatPerawatan::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.riwayatperawatan.index')
            ->with('success', 'Jadwal perawatan berhasil dihapus.');
    }
}