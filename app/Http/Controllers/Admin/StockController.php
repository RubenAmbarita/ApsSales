<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StockRequest;
use App\Models\StockApartment;
use App\Models\Tower;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $items = StockApartment::with(['tower','user'])->get();
            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <a href="'. route('stock.edit', $item->id) . '" class="btn btn-info">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                        <form action="'.route('stock.destroy', $item->id).'" method="POST" class="d-inline">
                                                        '.method_field('delete'). csrf_field() .'
                                                        
                                                        <button class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                    ';
                })
                ->make(true);
        }
        

        return view('pages.admin.stock.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $towers = Tower::all();
        $users = User::all();
        return view('pages.admin.stock.create', [
            'towers' => $towers,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockRequest $request)
    {
        $data = $request->all();
        StockApartment::create($data);
        return redirect()->route('stock.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = StockApartment::findOrFail($id);
        $towers = Tower::all();
        $users = User::all();
        
        return view('pages.admin.stock.edit', [
            'item' => $item,
            'towers' => $towers,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockRequest $request, string $id)
    {
        $data = $request->all();

        $item = StockApartment::findOrFail($id);
        $item->update($data);
        return redirect()->route('stock.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = StockApartment::findOrFail($id);
        $item->delete();

        return redirect()->route('stock.index');
    }
}
