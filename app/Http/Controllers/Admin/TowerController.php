<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TowerRequest;
use App\Models\Tower;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $items = Tower::all();
            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <a href="'. route('tower.edit', $item->id) . '" class="btn btn-info">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                        <form action="'.route('tower.destroy', $item->id).'" method="POST" class="d-inline">
                                                        '.method_field('delete'). csrf_field() .'
                                                        
                                                        <button class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                    ';
                })
                ->make(true);
        }
        

        return view('pages.admin.tower.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.tower.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TowerRequest $request)
    {
        $data = $request->all();
        Tower::create($data);
        return redirect()->route('tower.index');
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
        $item = Tower::findOrFail($id);

        return view('pages.admin.tower.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TowerRequest $request, string $id)
    {
        $data = $request->all();

        $item = Tower::findOrFail($id);
        $item->update($data);
        return redirect()->route('tower.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Tower::findOrFail($id);
        $item->delete();

        return redirect()->route('tower.index');
    }
}
