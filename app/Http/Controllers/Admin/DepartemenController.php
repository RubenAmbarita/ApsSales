<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DepartemenRequest;
use App\Models\Departemen;
use Yajra\DataTables\Facades\DataTables;

class DepartemenController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $items = Departemen::all();
            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <a href="'. route('admin.departemen.show', $item->id) . '" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="'. route('admin.departemen.edit', $item->id) . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form action="'.route('admin.departemen.destroy', $item->id).'" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="delete">
                            <input type="hidden" name="_token" value="'. csrf_token() .'">
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')" data-toggle="tooltip" data-placement="top" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->make(true);
        }
        
        return view('pages.admin.departemen.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.departemen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartemenRequest $request)
    {
        $data = $request->all();
        Departemen::create($data);
        return redirect()->route('admin.departemen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Departemen::findOrFail($id);
        return view('pages.admin.departemen.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Departemen::findOrFail($id);

        return view('pages.admin.departemen.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartemenRequest $request, string $id)
    {
        $data = $request->all();

        $item = Departemen::findOrFail($id);
        $item->update($data);
        return redirect()->route('admin.departemen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Departemen::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.departemen.index');
    }
}
