<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Server;
use App\Models\Network;
use App\Models\Lisensi;
use App\Models\Sop;
use App\Models\Location;
use App\Models\Vendor;
use App\Models\Departemen;
use App\Models\User;
use App\Models\RiwayatPerawatan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ringkasan utama
        $totalServers   = Server::count();
        $serverActive   = Server::whereIn('status', ['Aktif', 'Active'])->count();
        $serverMaint    = Server::whereIn('status', ['Perbaikan', 'Maintenance', 'Pemeliharaan'])->count();
        $serverInactive = Server::whereIn('status', ['Tidak Aktif', 'Inactive', 'Nonaktif', 'Down', 'Offline', 'Retired'])->count();

        $totalNetwork   = Network::count();
        $totalLisensi   = Lisensi::count();
        // Lisensi aktif berdasarkan tanggal kedaluwarsa atau status 'Aktif'
        $lisensiAktif   = Lisensi::where(function ($q) {
                                $q->whereDate('expiry_date', '>=', now()->toDateString())
                                  ->orWhereNull('expiry_date')
                                  ->orWhereIn('status', ['Aktif', 'Active']);
                            })->count();

        $totalSop       = Sop::count();
        $totalLocation  = Location::count();
        $totalVendor    = Vendor::count();
        $totalDept      = Departemen::count();
        $totalUsers     = User::count();

        $metrics = [
            'totalServers'   => $totalServers,
            'serverActive'   => $serverActive,
            'serverMaint'    => $serverMaint,
            'serverInactive' => $serverInactive,
            'totalNetwork'   => $totalNetwork,
            'totalLisensi'   => $totalLisensi,
            'lisensiAktif'   => $lisensiAktif,
            'totalSop'       => $totalSop,
            'totalLocation'  => $totalLocation,
            'totalVendor'    => $totalVendor,
            'totalDept'      => $totalDept,
            'totalUsers'     => $totalUsers,
        ];

        // Peringatan & tenggat waktu untuk panel bergaya kementerian
        // Hanya tampilkan lisensi yang masih aktif di dashboard (status Active/Aktif)
        $lisensiExpSoon = Lisensi::whereNotNull('expiry_date')
                                ->whereIn('status', ['Active', 'Aktif'])
                                ->whereDate('expiry_date', '>=', now()->toDateString())
                                ->whereDate('expiry_date', '<=', now()->addDays(90)->toDateString())
                                ->orderBy('expiry_date')
                                ->take(5)
                                ->get(['id','software_name','license_key','expiry_date','status']);

        // Hitung lisensi yang sudah kedaluwarsa hanya untuk yang berstatus Active/Aktif
        $lisensiExpired = Lisensi::whereNotNull('expiry_date')
                                ->whereIn('status', ['Active', 'Aktif'])
                                ->whereDate('expiry_date', '<', now()->toDateString())
                                ->count();

        // Jangan tampilkan perangkat jaringan yang statusnya Inactive
        $networkEoSupportSoon = Network::whereNotNull('eosupport_date')
                                ->where('status', '!=', 'Inactive')
                                ->whereDate('eosupport_date', '>=', now()->toDateString())
                                ->whereDate('eosupport_date', '<=', now()->addDays(90)->toDateString())
                                ->orderBy('eosupport_date')
                                ->take(5)
                                ->get(['id','brand','serial_number','eosupport_date','status']);

        $networkEoSupportPassed = Network::whereNotNull('eosupport_date')
                                ->whereDate('eosupport_date', '<', now()->toDateString())
                                ->count();


        // Pengumuman dinamis (aktif dan dalam rentang tanggal)
        $today = Carbon::today();
        $announcements = \App\Models\Announcement::query()
            ->where(function($q) use ($today) {
                $q->whereNull('start_date')->orWhereDate('start_date', '<=', $today);
            })
            ->where(function($q) use ($today) {
                $q->whereNull('end_date')->orWhereDate('end_date', '>=', $today);
            })
            ->where('is_active', true)
            ->orderByDesc('priority')
            ->orderByDesc('created_at')
            ->take(5)
            ->get(['id','title','content','start_date','end_date','priority']);

        // Jadwal perawatan mendatang (treatment_date di masa depan atau hari ini)
        $maintenanceUpcoming = RiwayatPerawatan::with('server')
                                    ->whereDate('treatment_date', '>=', now()->toDateString())
                                    ->orderBy('treatment_date')
                                    ->take(5)
                                    ->get(['id','id_server','treatment_date','treatment_type']);
        $maintenanceOverdue = RiwayatPerawatan::whereDate('treatment_date', '<', now()->toDateString())
                                    ->count();

        return view('pages.admin.dashboard', compact(
            'metrics',
            'lisensiExpSoon',
            'lisensiExpired',
            'networkEoSupportSoon',
            'networkEoSupportPassed',
            'announcements',
            'maintenanceUpcoming',
            'maintenanceOverdue'
        ));
    }
}
