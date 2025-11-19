<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sop;
use App\Models\Departemen;
use App\Http\Requests\Admin\SopRequest;
use Yajra\DataTables\Facades\DataTables;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Sop::with('departemen');
            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('owner', function($item){
                    return optional($item->departemen)->name ?: '-';
                })
                ->addColumn('action', function($item){
                    // Untuk role STAFF: hanya tampilkan tombol pratinjau (detail)
                    if (auth()->check() && auth()->user()->roles === 'STAFF') {
            return '<a href="'. route('admin.sop.show', $item->id) . '" class="btn btn-sm btn-soft-primary btn-pill btn-elevated btn-preview" data-toggle="tooltip" data-placement="top" title="Pratinjau"><i class="fas fa-eye me-2"></i><span class="btn-preview__label d-none d-md-inline">&nbsp;Pratinjau</span></a>';
                    }
                    // Role lain (ADMIN/KATIMJA): tampilkan lengkap (detail, edit, hapus)
                    return '
                        <a href="'. route('admin.sop.show', $item->id) . '" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye"></i></a>
                        <a href="'. route('admin.sop.edit', $item->id) . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                        <form action="'.route('admin.sop.destroy', $item->id).'" method="POST" class="d-inline">'.method_field('delete'). csrf_field() .'
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')" data-toggle="tooltip" data-placement="top" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->editColumn('effective_date', function($item){
                    return $item->effective_date ? $item->effective_date->format('d/m/Y') : '-';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.sop.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Departemen::orderBy('name')->get();
        return view('pages.admin.sop.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SopRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('sop', 'public');
            $data['file'] = $path;
        }

        Sop::create($data);
        return redirect()->route('admin.sop.index')->with('success', 'SOP berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Sop::findOrFail($id);
        return view('pages.admin.sop.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Sop::findOrFail($id);
        $departments = Departemen::orderBy('name')->get();
        return view('pages.admin.sop.edit', compact('item','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SopRequest $request, string $id)
    {
        $item = Sop::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('sop', 'public');
            $data['file'] = $path;
        }

        $item->update($data);
        return redirect()->route('admin.sop.index')->with('success', 'SOP berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Sop::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.sop.index')->with('success', 'SOP berhasil dihapus');
    }
}