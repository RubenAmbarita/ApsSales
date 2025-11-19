<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderByDesc('created_at')->paginate(10);
        return view('pages.admin.announcement.index', compact('announcements'));
    }

    public function create()
    {
        return view('pages.admin.announcement.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => [
                'nullable',
                'date',
                // Terapkan after_or_equal hanya jika start_date diisi
                Rule::when($request->filled('start_date'), 'after_or_equal:start_date')
            ],
            'priority' => 'nullable|in:low,medium,high',
            'is_active' => 'nullable|in:0,1',
        ]);
        $data['priority'] = $data['priority'] ?? 'medium';
        $data['is_active'] = $request->boolean('is_active');
        Announcement::create($data);
        return redirect()->route('admin.announcement.index')->with('status','Pengumuman berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        return view('pages.admin.announcement.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        return view('pages.admin.announcement.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required|string',
            'start_date' => 'nullable|date',
            'end_date' => [
                'nullable',
                'date',
                Rule::when($request->filled('start_date'), 'after_or_equal:start_date')
            ],
            'priority' => 'nullable|in:low,medium,high',
            'is_active' => 'nullable|in:0,1',
        ]);
        $data['priority'] = $data['priority'] ?? 'medium';
        $data['is_active'] = $request->boolean('is_active');
        $announcement->update($data);
        return redirect()->route('admin.announcement.index')->with('status','Pengumuman berhasil diperbarui');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return redirect()->route('admin.announcement.index')->with('status','Pengumuman dihapus');
    }
}