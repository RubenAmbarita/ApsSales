<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProsesRequest;
use App\Models\StockApartment;
use App\Models\Tower;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ApproveController extends Controller
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
                        <a href="'. route('approve.edit', $item->id) . '" class="btn btn-info">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                    ';
                })
                ->make(true);
        }
        

        return view('pages.admin.approve.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = StockApartment::findOrFail($id);
        $towers = Tower::all();
        $users = User::all();
        
        return view('pages.admin.approve.edit', [
            'item' => $item,
            'towers' => $towers,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProsesRequest $request, string $id)
    {
        $data = $request->all();

        $item = StockApartment::findOrFail($id);
        $item->update($data);
        return redirect()->route('approve.index');
    }
}
