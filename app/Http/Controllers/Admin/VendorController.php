<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VendorRequest;
use App\Models\Vendor;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $items = Vendor::all();
            // $items = Vendor::with(['tower','user'])->get();
            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <a href="'. route('admin.vendor.show', $item->id) . '" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-eye"></i></a>
                        <a href="'. route('admin.vendor.edit', $item->id) . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil-alt"></i></a>
                        <form action="'.route('admin.vendor.destroy', $item->id).'" method="POST" class="d-inline">'.method_field('delete'). csrf_field() .'
                            <button class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')" data-toggle="tooltip" data-placement="top" title="Hapus">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    ';
                })
                ->make(true);
        }
        
        return view('pages.admin.vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.vendor.create');
        // $towers = Tower::all();
        // $users = User::all();
        // return view('pages.admin.stock.create', [
        //     'towers' => $towers,
        //     'users' => $users
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {
        $data = $request->all();
        Vendor::create($data);
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Vendor::findOrFail($id);
        return view('pages.admin.vendor.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Vendor::findOrFail($id);

        return view('pages.admin.vendor.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request, string $id)
    {
        $data = $request->all();

        $item = Vendor::findOrFail($id);
        $item->update($data);
        return redirect()->route('admin.vendor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Vendor::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.vendor.index');
    }
}
