<?php

namespace App\Http\Controllers\Admin;

use App\Models\Network;
use App\Models\Location;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Query dasar dengan relasi
        $query = Network::with(['location', 'vendor']);

        // Filter berdasarkan vendor (id)
        if ($request->filled('vendor_id')) {
            $query->where('id_vendor', $request->input('vendor_id'));
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $networks = $query->get();

        // Data vendor untuk dropdown filter
        $vendors = Vendor::orderBy('name')->get();

        return view('pages.admin.network.index', [
            'networks' => $networks,
            'vendors' => $vendors,
            'filters' => [
                'vendor_id' => $request->input('vendor_id'),
                'status' => $request->input('status'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locations = Location::all();
        $vendors = Vendor::all();
        return view('pages.admin.network.create', compact('locations', 'vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_location' => 'required|exists:tb_location,id',
            'id_vendor' => 'required|exists:tb_vendor,id',
            'brand' => 'required|string|max:255',
            'production_year' => 'required|string|max:4',
            'function' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'eosale_date' => 'required|date',
            'eosupport_date' => 'required|date',
            'status' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        Network::create($request->all());

        return redirect()->route('admin.network.index')
            ->with('success', 'Perangkat jaringan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Network $network)
    {
        return view('pages.admin.network.show', compact('network'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Network $network)
    {
        $locations = Location::all();
        $vendors = Vendor::all();
        return view('pages.admin.network.edit', compact('network', 'locations', 'vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Network $network)
    {
        $request->validate([
            'id_location' => 'required|exists:tb_location,id',
            'id_vendor' => 'required|exists:tb_vendor,id',
            'brand' => 'required|string|max:255',
            'production_year' => 'required|string|max:4',
            'function' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255',
            'eosale_date' => 'required|date',
            'eosupport_date' => 'required|date',
            'status' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $network->update($request->all());

        return redirect()->route('admin.network.index')
            ->with('success', 'Perangkat jaringan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Network $network)
    {
        $network->delete();

        return redirect()->route('admin.network.index')
            ->with('success', 'Perangkat jaringan berhasil dihapus');
    }
}