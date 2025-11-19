<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Departemen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $items = User::with(['departemen'])->get();
            return DataTables::of($items)
                ->addIndexColumn()
                ->addColumn('action', function($item){
                    return '
                        <a href="'. route('admin.user.show', $item->id) . '" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="'. route('admin.user.edit', $item->id) . '" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="fa fa-pencil-alt"></i>
                        </a>
                        <form action="'.route('admin.user.destroy', $item->id).'" method="POST" class="d-inline">
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

        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departemens = Departemen::all();
        return view('pages.admin.user.create', [
            'departemens' => $departemens
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        try {
            User::create($data);
        } catch (QueryException $e) {
            // Tangani pelanggaran unik supaya tidak menampilkan error SQL mentah
            if ($e->getCode() === '23000') { // Integrity constraint violation
                $msg = $e->getMessage();
                if (Str::contains($msg, 'users_nip_unique')) {
                    return back()->withErrors(['nip' => 'NIP sudah terdaftar.'])->withInput();
                }
                if (Str::contains($msg, 'users_email_unique')) {
                    return back()->withErrors(['email' => 'Email sudah terdaftar.'])->withInput();
                }
                return back()->withErrors(['form' => 'Data melanggar aturan unik. Periksa NIP/Email.'])->withInput();
            }
            throw $e;
        }
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = User::with(['departemen'])->findOrFail($id);
        return view('pages.admin.user.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = User::findOrFail($id);
        $departemens = Departemen::all();
        return view('pages.admin.user.edit', [
            'item' => $item,
            'departemens' => $departemens
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->all();
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $item = User::findOrFail($id);
        try {
            $item->update($data);
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                $msg = $e->getMessage();
                if (Str::contains($msg, 'users_nip_unique')) {
                    return back()->withErrors(['nip' => 'NIP sudah terdaftar.'])->withInput();
                }
                if (Str::contains($msg, 'users_email_unique')) {
                    return back()->withErrors(['email' => 'Email sudah terdaftar.'])->withInput();
                }
                return back()->withErrors(['form' => 'Data melanggar aturan unik. Periksa NIP/Email.'])->withInput();
            }
            throw $e;
        }
        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.user.index');
    }
}
