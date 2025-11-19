<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Server;
use App\Http\Requests\Admin\ServerRequest;
use Yajra\DataTables\Facades\DataTables;

class ServerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Server::query();

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('status', function($item){
                    $status = $item->status ?: '-';
                    $statusLower = $item->status ? strtolower($item->status) : null;
                    $class = 'badge-secondary';
                    if (in_array($statusLower, ['aktif','active'])) {
                        $class = 'badge-success';
                    } elseif (in_array($statusLower, ['perbaikan','maintenance','pemeliharaan'])) {
                        $class = 'badge-warning';
                    } elseif (in_array($statusLower, ['tidak aktif','inactive'])) {
                        $class = 'badge-secondary';
                    }
                    return $item->status ? '<span class="badge '.$class.'">'.$status.'</span>' : '-';
                })
                ->editColumn('procurement_date', function($item){
                    return $item->procurement_date ? $item->procurement_date->format('d/m/Y') : '-';
                })
                ->editColumn('acquition_date', function($item){
                    return $item->acquition_date ? $item->acquition_date->format('d/m/Y') : '-';
                })
                ->addColumn('action', function($item){
                    // Untuk role STAFF: hanya tampilkan tombol pratinjau (detail)
                    if (auth()->check() && auth()->user()->roles === 'STAFF') {
            return '<a href="'. route('admin.server.show', $item->id) . '" class="btn btn-sm btn-soft-primary btn-pill btn-elevated btn-preview" data-toggle="tooltip" data-placement="top" title="Pratinjau"><i class="fas fa-eye me-2"></i><span class="btn-preview__label d-none d-md-inline">&nbsp;Pratinjau</span></a>';
                    }
                    // Role lain (ADMIN/KATIMJA): tampilkan lengkap (detail, edit, hapus)
                    return '
                        <a href="'. route('admin.server.show', $item->id) . '" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye"></i></a>
                        <a href="'. route('admin.server.edit', $item->id) . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                        <form action="'.route('admin.server.destroy', $item->id).'" method="POST" class="d-inline">'.method_field('delete'). csrf_field() .'
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')" data-toggle="tooltip" data-placement="top" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }

        return view('pages.admin.server.index');
    }

    public function create()
    {
        return view('pages.admin.server.create');
    }

    public function store(ServerRequest $request)
    {
        $data = $request->validated();
        Server::create($data);
        return redirect()->route('admin.server.index')->with('success', 'Server berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $item = Server::findOrFail($id);
        return view('pages.admin.server.show', compact('item'));
    }

    public function edit(string $id)
    {
        $item = Server::findOrFail($id);
        return view('pages.admin.server.edit', compact('item'));
    }

    public function update(ServerRequest $request, string $id)
    {
        $item = Server::findOrFail($id);
        $data = $request->validated();
        $item->update($data);
        return redirect()->route('admin.server.index')->with('success', 'Server berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $item = Server::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.server.index')->with('success', 'Server berhasil dihapus');
    }
}