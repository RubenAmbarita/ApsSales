<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lisensi;
use App\Models\Vendor;
use App\Http\Requests\Admin\LisensiRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class LisensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Apply server-side filters using query builder for better DataTables integration
            $query = Lisensi::with('vendor');

            // New OR-based filtering logic
            $vendorId = $request->input('filter_vendor_id');
            $vendorText = $request->input('filter_vendor');
            $status = $request->input('filter_status');

            if ($vendorId || $status || $vendorText) {
                $query->where(function($q) use ($vendorId, $status, $vendorText) {
                    if ($vendorId) {
                        $q->orWhere('id_vendor', $vendorId);
                    }
                    if ($status) {
                        $q->orWhere('status', $status);
                    }
                    // If vendorId not set but vendor text provided, allow OR by vendor name
                    if (!$vendorId && $vendorText) {
                        $q->orWhereHas('vendor', function($vq) use ($vendorText) {
                            $vq->where('name', 'like', "%{$vendorText}%");
                        });
                    }
                });
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('vendor_name', function($item){
                    return $item->vendor ? $item->vendor->name : '-';
                })
                ->editColumn('status', function($item){
                    $statusLower = Str::lower($item->status);
                    $icon = match($statusLower) {
                        'aktif' => 'fa-check-circle',
                        'kadaluarsa' => 'fa-exclamation-triangle',
                        'nonaktif' => 'fa-pause-circle',
                        default => 'fa-info-circle'
                    };
                    $softClass = match($statusLower) {
                        'aktif' => 'badge-soft-success',
                        'kadaluarsa' => 'badge-soft-danger',
                        'nonaktif' => 'badge-soft-secondary',
                        default => 'badge-soft-info'
                    };
                    return '<span class="badge badge-pill status-badge '.$softClass.'"><i class="fas '.$icon.' mr-1"></i>'.e($item->status).'</span>';
                })
                ->addColumn('masa_berlaku', function($item){
                    $start = $item->start_date ? $item->start_date->format('d/m/Y') : '-';
                    $end = $item->expiry_date ? $item->expiry_date->format('d/m/Y') : '-';
                    $daysLeft = $item->expiry_date ? now()->diffInDays($item->expiry_date, false) : null;
                    // Only show remaining days badge when still active; remove expired text entirely
                    $badgeDays = '';
                    if ($daysLeft !== null && $daysLeft > 0) {
                        $badgeClass = $daysLeft <= 30 ? 'badge-warning' : 'badge-success';
                        $badgeDays = '<span class="badge '.$badgeClass.'">'.$daysLeft.' hari lagi</span>';
                    }
                    $note = $badgeDays ? '<div class="mt-1">'.$badgeDays.'</div>' : '';
                    return '<div><div class="date-line text-nowrap">'.$start.' - '.$end.'</div>'.$note.'</div>';
                })
                ->addColumn('action', function($item){
                    // Untuk role STAFF: hanya tampilkan tombol pratinjau (detail)
                    if (auth()->check() && auth()->user()->roles === 'STAFF') {
            return '<a href="'. route('admin.lisensi.show', $item->id) . '" class="btn btn-sm btn-soft-primary btn-pill btn-elevated btn-preview" data-toggle="tooltip" data-placement="top" title="Pratinjau"><i class="fas fa-eye me-2"></i><span class="btn-preview__label d-none d-md-inline">&nbsp;Pratinjau</span></a>';
                    }
                    // Role lain (ADMIN/KATIMJA): tampilkan lengkap (detail, edit, hapus)
                    return '
                        <a href="'. route('admin.lisensi.show', $item->id) . '" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye"></i></a>
                        <a href="'. route('admin.lisensi.edit', $item->id) . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                        <form action="'.route('admin.lisensi.destroy', $item->id).'" method="POST" class="d-inline">'.method_field('delete'). csrf_field() .'
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')" data-toggle="tooltip" data-placement="top" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['status','masa_berlaku','action'])
                ->make(true);
        }

        // Non-AJAX (initial page render): provide vendors for dropdown
        $vendors = Vendor::orderBy('name')->get();
        return view('pages.admin.lisensi.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::orderBy('name')->get();
        return view('pages.admin.lisensi.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LisensiRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('licenses', 'public');
            $data['file'] = $path;
        }

        Lisensi::create($data);
        return redirect()->route('admin.lisensi.index')->with('success', 'Lisensi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Lisensi::with('vendor')->findOrFail($id);
        return view('pages.admin.lisensi.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Lisensi::findOrFail($id);
        $vendors = Vendor::orderBy('name')->get();
        return view('pages.admin.lisensi.edit', compact('item','vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LisensiRequest $request, string $id)
    {
        $item = Lisensi::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('licenses', 'public');
            $data['file'] = $path;
        }

        $item->update($data);
        return redirect()->route('admin.lisensi.index')->with('success', 'Lisensi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Lisensi::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.lisensi.index')->with('success', 'Lisensi berhasil dihapus');
    }
}