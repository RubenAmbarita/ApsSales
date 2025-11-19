@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Header card SIMANTAP Dashboard dihapus sesuai permintaan -->

    <style>
        /* KPI Bento Style: lebih modern, lembut, tidak kaku */
        .kpi-card {
            position: relative;
            border: none;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(17,24,39,.06);
            transition: box-shadow .18s ease, transform .18s ease, background .18s ease;
            cursor: pointer;
            overflow: hidden;
        }
        .kpi-card:hover { transform: translateY(-2px); box-shadow: 0 14px 28px rgba(17,24,39,.12); }
        /* Hapus underline pada anchor card */
        a.kpi-card { text-decoration: none !important; color: inherit; }
        a.kpi-card:hover, a.kpi-card:focus { text-decoration: none !important; color: inherit; }
        a.kpi-card h3, a.kpi-card .kpi-sub { text-decoration: none; }
        .kpi-card.kpi-bento::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,.0) 0%, rgba(255,255,255,.4) 100%);
            pointer-events: none;
        }
        /* Accent bubble di sudut untuk nuansa lebih playful */
        .kpi-card.kpi-bento::after {
            content: "";
            position: absolute;
            right: -48px; /* geser lebih keluar agar tidak terlalu menonjol di sisi kanan */
            top: -48px;
            width: 120px;  /* perkecil ukuran bubble */
            height: 120px;
            border-radius: 50%;
            background: radial-gradient(circle at 40% 40%, rgba(78,115,223,.20), transparent 65%); /* turunkan intensitas warna */
            opacity: .18; /* kurangi opacity keseluruhan */
            pointer-events: none;
        }
        /* */
        .kpi-card .icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(17,24,39,.06);
            color: var(--accent, #4e73df);
            transition: transform .18s ease, box-shadow .18s ease;
        }
        .kpi-card h3 { font-weight: 800; color: #111827; font-size: 1.75rem; letter-spacing: .2px; }
        .kpi-sub { font-size: .78rem; color: #6b7280; letter-spacing: .5px; text-transform: uppercase; }
        
        /* Palette */
        .kpi-card.primary  { --accent: #4e73df; background: linear-gradient(135deg, rgba(78,115,223,.18) 0%, rgba(78,115,223,.06) 60%), #fff; }
        .kpi-card.info     { --accent: #36b9cc; background: linear-gradient(135deg, rgba(54,185,204,.22) 0%, rgba(54,185,204,.07) 60%), #fff; }
        .kpi-card.secondary{ --accent: #858796; background: linear-gradient(135deg, rgba(133,135,150,.20) 0%, rgba(133,135,150,.06) 60%), #fff; }
        .kpi-card.warning  { --accent: #f6c23e; background: linear-gradient(135deg, rgba(246,194,62,.26) 0%, rgba(246,194,62,.08) 60%), #fff; }
        /* Indigo variant (#6366f1) for Lisensi & Tenggat */
        .kpi-card.indigo   { --accent: #6366f1; background: linear-gradient(135deg, rgba(99,102,241,.26) 0%, rgba(99,102,241,.08) 60%), #fff; }
        .kpi-card.primary .icon    { background: rgba(78,115,223,.18); color: #4468d0; box-shadow: 0 6px 14px rgba(78,115,223,.18); }
        .kpi-card.info .icon       { background: rgba(54,185,204,.22); color: #2fa8ba; box-shadow: 0 6px 14px rgba(54,185,204,.20); }
        .kpi-card.secondary .icon  { background: rgba(133,135,150,.22); color: #6b7280; box-shadow: 0 6px 14px rgba(133,135,150,.20); }
        .kpi-card.warning .icon    { background: rgba(246,194,62,.28); color: #c68d07; box-shadow: 0 6px 14px rgba(246,194,62,.24); }
        .kpi-card.indigo .icon     { background: rgba(99,102,241,.28); color: #4f46e5; box-shadow: 0 6px 14px rgba(99,102,241,.22); }
        .kpi-chevron { margin-left: auto; color: #9ca3af; transition: color .18s ease; }
        .kpi-card:hover .kpi-chevron { color: #6b7280; transform: translateX(2px); }
        .kpi-card:hover .icon { transform: scale(1.03); }
        /* Sesuaikan warna bubble per varian */
        .kpi-card.primary.kpi-bento::after   { background: radial-gradient(circle at 40% 40%, rgba(78,115,223,.20), transparent 65%); }
        .kpi-card.info.kpi-bento::after      { background: radial-gradient(circle at 40% 40%, rgba(54,185,204,.20), transparent 65%); }
        .kpi-card.secondary.kpi-bento::after { background: radial-gradient(circle at 40% 40%, rgba(133,135,150,.18), transparent 65%); }
        .kpi-card.warning.kpi-bento::after   { background: radial-gradient(circle at 40% 40%, rgba(246,194,62,.22), transparent 65%); }
        .kpi-card.indigo.kpi-bento::after    { background: radial-gradient(circle at 40% 40%, rgba(99,102,241,.22), transparent 65%); }
        .progress { height: 8px; }
        .table-rounded { border:1px solid #e9edf5; border-radius: 12px; overflow: hidden; }
        /* Uniform width untuk badge prioritas pengumuman */
        .badge-priority {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 90px; /* samakan lebar untuk HIGH/MEDIUM/LOW */
            text-align: center;
        }

        /* Papan Pengumuman – gaya cantik */
        .announce-card {
            border: 1px solid #e6ecf3;
            border-left-width: 4px;
            border-radius: 12px;
            padding: 12px 14px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(17,24,39,.04);
            transition: box-shadow .2s ease, transform .2s ease;
            display: block;                   /* agar anchor full area */
            text-decoration: none !important; /* hilangkan underline jika anchor */
            color: inherit;                   /* warna teks mengikuti konten */
        }
        /* Batasi tampilan pengumuman hanya 3 item, sisanya bisa di-scroll */
        .announce-list {
            max-height: 320px;               /* tinggi kira-kira untuk 3 kartu */
            overflow-y: auto;
            scrollbar-width: thin;           /* Firefox */
            scrollbar-color: rgba(17,24,39,.25) transparent;
            padding-right: 4px;              /* ruang untuk scrollbar agar tidak memotong konten */
        }
        .announce-list:hover { scrollbar-color: rgba(17,24,39,.40) transparent; }
        /* WebKit scrollbar styling */
        .announce-list::-webkit-scrollbar { width: 6px; }
        .announce-list::-webkit-scrollbar-thumb { background: rgba(17,24,39,.22); border-radius: 8px; }
        .announce-list:hover::-webkit-scrollbar-thumb { background: rgba(17,24,39,.36); }
        @media (max-width: 576px) { .announce-list { max-height: 260px; } }
        .announce-card:hover { transform: translateY(-1px); box-shadow: 0 8px 18px rgba(17,24,39,.06); }
        .announce-card.card-click { cursor: pointer; }
        .announce-card.card-click:focus-visible { outline: none; box-shadow: 0 0 0 2px rgba(17,24,39,.12), 0 0 0 4px rgba(17,24,39,.08); }
        .announce-card.accent-danger { border-left-color: #e74a3b; }
        .announce-card.accent-primary { border-left-color: #4e73df; }
        /* Royal Purple variant for Lisensi cards */
        .announce-card.accent-purple { border-left-color: #7c3aed; }
        /* Deep Indigo variant (#6366f1) */
        .announce-card.accent-indigo { border-left-color: #6366f1; }
        .announce-card.accent-info { border-left-color: #36b9cc; }
        .announce-card.accent-warning { border-left-color: #f6c23e; }
        .announce-card.accent-secondary { border-left-color: #858796; }
        /* Varian gradasi khusus untuk kartu Network & EoSupport agar nuansa #36b9cc lebih terasa */
        .announce-card.info-gradient {
            background: linear-gradient(135deg, rgba(54,185,204,.12) 0%, rgba(54,185,204,.05) 60%), #ffffff;
        }
        .announce-card.info-gradient:hover {
            box-shadow: 0 8px 18px rgba(54,185,204,.10);
        }
        .announce-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(17,24,39,.08);
        }
        .announce-icon.danger { background: rgba(231,74,59,.12); color: #e74a3b; border-color: rgba(231,74,59,.25); }
        .announce-icon.primary { background: rgba(78,115,223,.14); color: #4e73df; border-color: rgba(78,115,223,.30); }
        .announce-icon.purple { background: rgba(124,58,237,.14); color: #7c3aed; border-color: rgba(124,58,237,.30); }
        .announce-icon.indigo { background: rgba(99,102,241,.14); color: #6366f1; border-color: rgba(99,102,241,.30); }
        .announce-icon.info { background: rgba(54,185,204,.12); color: #36b9cc; border-color: rgba(54,185,204,.25); }
        .announce-icon.warning { background: rgba(246,194,62,.14); color: #f6c23e; border-color: rgba(246,194,62,.35); }
        .announce-icon.secondary { background: rgba(133,135,150,.12); color: #858796; border-color: rgba(133,135,150,.25); }
        .announce-title { font-weight: 600; color: #111827; }
        .announce-content { color: #6b7280; }

        /* Tombol Lihat Detail – micro button kotak rounded 8px, compact & elegan */
        .btn-announce {
            display: inline-flex;
            align-items: center;
            gap: 4px;                       /* lebih rapat */
            padding: 1px 6px;               /* lebih kecil lagi */
            border-radius: 8px;             /* tetap kotak rounded 8px */
            font-weight: 600;
            font-size: .76rem;              /* perkecil teks */
            line-height: 1.0;               /* sangat padat */
            border: 1px solid rgba(17,24,39,.10);
            background: rgba(17,24,39,.02);
            color: #374151;
            text-decoration: none !important;
            transition: transform .15s ease, box-shadow .2s ease, color .15s ease, background-color .15s ease, border-color .15s ease;
        }
        .btn-announce .icon { font-size: .70em; line-height: 1; transition: transform .15s ease; color: inherit; }
        .btn-announce:hover { transform: translateY(-1px); box-shadow: 0 6px 12px rgba(17,24,39,.07); }
        .btn-announce:hover .icon { transform: translateX(1px); }
        .btn-announce:focus-visible { outline: none; box-shadow: 0 0 0 2px rgba(17,24,39,.12), 0 0 0 4px rgba(17,24,39,.08); }
        /* Variasi warna mengikuti prioritas */
        .btn-announce.danger { background: rgba(231,74,59,.10); color: #b4352a; border-color: rgba(231,74,59,.32); }
        .btn-announce.info { background: rgba(54,185,204,.12); color: #1e8797; border-color: rgba(54,185,204,.32); }
        .btn-announce.secondary { background: rgba(133,135,150,.12); color: #525a66; border-color: rgba(133,135,150,.28); }
        .btn-announce.danger:hover { background: rgba(231,74,59,.18); border-color: rgba(231,74,59,.45); box-shadow: 0 8px 16px rgba(231,74,59,.15); }
        .btn-announce.info:hover { background: rgba(54,185,204,.18); border-color: rgba(54,185,204,.45); box-shadow: 0 8px 16px rgba(54,185,204,.15); }
        .btn-announce.secondary:hover { background: rgba(133,135,150,.18); border-color: rgba(133,135,150,.38); box-shadow: 0 8px 16px rgba(133,135,150,.12); }

        /* Chip Tanggal (Mulai/Berakhir) – kecil, cantik, konsisten */
        .date-row { display: flex; align-items: center; gap: 4px; flex-wrap: wrap; }
        .date-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 1px 6px;
            border-radius: 8px;
            font-size: .76rem;
            line-height: 1.0;
            border: 1px solid rgba(17,24,39,.10);
            background: rgba(17,24,39,.02);
            color: #374151;
            transition: box-shadow .2s ease, background-color .15s ease, border-color .15s ease;
        }
        .date-chip .date-icon { font-size: .70em; color: #6b7280; }
        .date-chip .date-label { font-weight: 600; color: #374151; }
        .date-chip .date-sep { color: #9ca3af; }
        .date-chip .date-text { color: #374151; }
        .date-chip:hover { box-shadow: 0 6px 12px rgba(17,24,39,.07); background: rgba(17,24,39,.04); border-color: rgba(17,24,39,.16); }
        /* Sedikit aksen berbeda untuk start/end */
        .date-chip.start .date-icon { color: #10b981; }      /* hijau lembut */
        .date-chip.end .date-icon { color: #f59e0b; }        /* amber lembut */
        /* Aksen halus mengikuti prioritas saat hover */
        .date-chip.danger:hover { border-color: rgba(231,74,59,.30); background: rgba(231,74,59,.06); }
        .date-chip.primary:hover { border-color: rgba(78,115,223,.30); background: rgba(78,115,223,.06); }
        .date-chip.purple:hover { border-color: rgba(124,58,237,.30); background: rgba(124,58,237,.06); }
        .date-chip.indigo:hover { border-color: rgba(99,102,241,.30); background: rgba(99,102,241,.06); }
        /* Badge variant to match purple and indigo accents */
        .badge.badge-purple { background: rgba(124,58,237,.14); color: #7c3aed; border: 1px solid rgba(124,58,237,.30); }
        .badge.badge-indigo { background: rgba(99,102,241,.14); color: #6366f1; border: 1px solid rgba(99,102,241,.30); }
        .date-chip.info:hover { border-color: rgba(54,185,204,.30); background: rgba(54,185,204,.06); }
        .date-chip.warning:hover { border-color: rgba(246,194,62,.35); background: rgba(246,194,62,.08); }
        .date-chip.secondary:hover { border-color: rgba(133,135,150,.28); background: rgba(133,135,150,.05); }
        /* Alert & Deadline – kartu bergaya korporat */
        .section-head { display:flex; align-items:center; justify-content:flex-start; gap:8px; }
        .section-head .head-icon { width:28px; height:28px; border-radius:8px; display:flex; align-items:center; justify-content:center; border:1px solid rgba(17,24,39,.08); color:#6b7280; background: rgba(17,24,39,.04); }
        .deadline-list { display:flex; flex-direction:column; gap:8px; }
        .deadline-item {
            position: relative;
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:12px;
            padding:10px 12px;
            border-radius:12px;
            border:1px solid #e6ecf3;
            background:#ffffff;
            box-shadow: 0 4px 12px rgba(17,24,39,.04);
            transition: box-shadow .2s ease, transform .2s ease;
        }
        .deadline-item:hover { transform: translateY(-1px); box-shadow: 0 8px 18px rgba(17,24,39,.06); }
        .deadline-item::before {
            content:"";
            position:absolute;
            left:0; top:0; bottom:0;
            width:4px; border-radius:12px 0 0 12px;
            background: var(--accent-color, rgba(17,24,39,.12));
        }
        .deadline-item .title { font-weight:600; color:#111827; }
        .deadline-item .meta { color:#6b7280; font-size:.85rem; }
        .deadline-item .tag {
            display:inline-flex; align-items:center; gap:4px;
            padding:2px 6px; border-radius:8px; font-size:.76rem; line-height:1;
            border:1px solid rgba(17,24,39,.10); background: rgba(17,24,39,.02); color:#374151;
        }
        /* Percantik nama lisensi dan key/serial untuk gaya korporat */
        .deadline-item .title { font-weight:700; font-size:1rem; letter-spacing:.2px; }
        .tag.key { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; letter-spacing:.3px; background: rgba(246,194,62,.10); border-color: rgba(246,194,62,.30); color:#2f3136; }
        .tag.serial { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; letter-spacing:.3px; background: rgba(54,185,204,.12); border-color: rgba(54,185,204,.30); color:#2f3136; }
        .tag .code { font-weight:600; }
        .deadline-item .right { display:flex; align-items:center; gap:6px; }
        .deadline-item.warning { --accent-color: #f6c23e; }
        .deadline-item.info { --accent-color: #36b9cc; }
        .deadline-item.danger { --accent-color: #e74a3b; }
        .deadline-item.empty { border-style:dashed; color:#6b7280; background: #fafbfc; box-shadow:none; }
        .table-rounded { border-radius: 12px; }
    </style>

    <!-- Row 1: KPI utama (Bento style, lebih modern dan tidak kaku) -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="card kpi-card kpi-bento primary h-100" href="{{ route('admin.server.index') }}">
                <div class="card-body d-flex align-items-center">
                    <div class="icon mr-3"><i class="fas fa-server"></i></div>
                    <div>
                        <div class="kpi-sub">Total Server</div>
                        <h3 class="mb-0">{{ number_format($metrics['totalServers']) }}</h3>
                    </div>
                    <i class="fas fa-chevron-right kpi-chevron"></i>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="card kpi-card kpi-bento info h-100" href="{{ route('admin.network.index') }}">
                <div class="card-body d-flex align-items-center">
                    <div class="icon mr-3"><i class="fas fa-network-wired"></i></div>
                    <div>
                        <div class="kpi-sub">Total Network</div>
                        <h3 class="mb-0">{{ number_format($metrics['totalNetwork']) }}</h3>
                    </div>
                    <i class="fas fa-chevron-right kpi-chevron"></i>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="card kpi-card kpi-bento secondary h-100" href="{{ route('admin.sop.index') }}">
                <div class="card-body d-flex align-items-center">
                    <div class="icon mr-3"><i class="fas fa-file-alt"></i></div>
                    <div>
                        <div class="kpi-sub">Total SOP</div>
                        <h3 class="mb-0">{{ number_format($metrics['totalSop']) }}</h3>
                    </div>
                    <i class="fas fa-chevron-right kpi-chevron"></i>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <a class="card kpi-card kpi-bento warning h-100" href="{{ route('admin.lisensi.index') }}">
                <div class="card-body d-flex align-items-center">
                    <div class="icon mr-3"><i class="fas fa-key"></i></div>
                    <div>
                        <div class="kpi-sub">Total Lisensi</div>
                        <h3 class="mb-0">{{ number_format($metrics['totalLisensi']) }}</h3>
                    </div>
                    <i class="fas fa-chevron-right kpi-chevron"></i>
                </div>
            </a>
        </div>
        <!-- Card: Network mendekati End of Support (< 90 hari) - rollback, dipindahkan kembali ke Row 3 -->
    </div>



    <!-- Row 2 dihapus: Tindakan Cepat -->

    <!-- Row 3: Peringatan & distribusi status -->
    <div class="row">
        <!-- Papan Pengumuman Internal -->
        <div class="col-xl-6 mb-4">
            <div class="card kpi-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 text-uppercase text-muted">Papan Pengumuman</h6>
                        <div class="small text-muted">Hari ini: {{ now()->format('d M Y') }}</div>
                    </div>
                    <div class="announce-list">
                    <ul class="list-unstyled mb-0">
                        @forelse($announcements as $a)
                            @php
                                $badge = strtolower($a->priority) === 'high'
                                    ? 'danger'
                                    : (strtolower($a->priority) === 'low' ? 'secondary' : 'warning');
                            @endphp
                            <li class="mb-3">
                                <a href="{{ route('admin.announcement.show', $a->id) }}" class="announce-card accent-{{ $badge }} card-click">
                                    <div class="d-flex align-items-start">
                                        <div class="announce-icon {{ $badge }} mr-3"><i class="fas fa-bullhorn"></i></div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="announce-title">{{ $a->title }}</div>
                                                <span class="badge badge-{{ $badge }} badge-priority text-uppercase">{{ $a->priority }}</span>
                                            </div>
                                            <div class="announce-content small mt-1">{{ \Illuminate\Support\Str::limit(strip_tags($a->content), 120) }}</div>
                                            <div class="date-row mt-2">
                                                @if($a->start_date)
                                                    <span class="date-chip {{ $badge }} start"><i class="fas fa-calendar-alt date-icon"></i><span class="date-label">Mulai</span><span class="date-sep">:</span><span class="date-text">{{ optional($a->start_date)->format('d M Y') }}</span></span>
                                                @endif
                                                @if($a->end_date)
                                                    <span class="date-chip {{ $badge }} end"><i class="fas fa-calendar-alt date-icon"></i><span class="date-label">Berakhir</span><span class="date-sep">:</span><span class="date-text">{{ optional($a->end_date)->format('d M Y') }}</span></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li class="empty-state-announcement">
                                <div class="text-center py-4">
                                    <div class="empty-icon mb-3">
                                        <i class="fas fa-bullhorn" style="font-size: 3rem; color: #e3e6f0;"></i>
                                    </div>
                                    <h6 class="text-muted mb-2">Tidak Ada Pengumuman</h6>
                                    <p class="text-muted small">Belum ada pengumuman aktif yang perlu ditampilkan saat ini.</p>
                                </div>
                            </li>
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card dipindahkan: Lisensi akan kedaluwarsa (< 90 hari) -->

        <!-- Card: Network mendekati End of Support (< 90 hari) -->
        <div class="col-xl-6 mb-4">
            <div class="card kpi-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 text-uppercase text-muted">Network &amp; EoSupport</h6>
                        <div class="small text-muted">{{ now()->format('d M Y') }}</div>
                    </div>
                    <div class="announce-list">
                        <ul class="list-unstyled mb-0">
                            @forelse($networkEoSupportSoon as $net)
                                <li class="mb-3">
                                    <a href="{{ route('admin.network.show', $net->id) }}" class="announce-card accent-info card-click">
                                        <div class="d-flex align-items-start">
                                            <div class="announce-icon info mr-3"><i class="fas fa-network-wired"></i></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="announce-title">
                                                        {{ $net->brand }}
                                                        <span class="small text-muted">— {{ \Illuminate\Support\Str::limit($net->serial_number, 16) }}</span>
                                                    </div>
                                                    <span class="badge badge-info badge-priority text-uppercase">EoSupport</span>
                                                </div>
                                                <div class="announce-content small mt-1">
                                                    {{ $net->model ?? $net->type ?? 'Perangkat Jaringan' }}
                                                </div>
                                                <div class="date-row mt-2">
                                                    <span class="date-chip info end">
                                                        <i class="fas fa-calendar-alt date-icon"></i>
                                                        <span class="date-label">EoSupport</span>
                                                        <span class="date-sep">:</span>
                                                        <span class="date-text">{{ optional($net->eosupport_date)->format('d M Y') }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="empty-state-announcement">
                                    <div class="text-center py-4">
                                        <div class="empty-icon mb-3">
                                            <i class="fas fa-network-wired" style="font-size: 3rem; color: #e3e6f0;"></i>
                                        </div>
                                        <h6 class="text-muted mb-2">Tidak Ada Perangkat Mendekati EoSupport</h6>
                                        <p class="text-muted small">Semua perangkat jaringan masih dalam masa dukungan. Tidak ada tindakan yang diperlukan saat ini.</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                        <div class="mt-2 small text-muted">Sudah lewat EoSupport: {{ number_format($networkEoSupportPassed) }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Row 4: Jadwal Perawatan & EoSale -->
    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card kpi-card kpi-bento warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 text-uppercase text-muted">Jadwal Perawatan Server</h6>
                        <span class="badge badge-light">Overdue: {{ number_format($maintenanceOverdue) }}</span>
                    </div>
                    <div class="announce-list">
                        <ul class="list-unstyled mb-0">
                            @forelse($maintenanceUpcoming as $m)
                                <li class="mb-3">
                                    <a href="{{ route('admin.riwayatperawatan.show', $m->id) }}" class="announce-card accent-warning card-click">
                                        <div class="d-flex align-items-start">
                                            <div class="announce-icon warning mr-3"><i class="fas fa-tools"></i></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="announce-title">
                                                        {{ optional($m->server)->brand }} {{ optional($m->server)->model }}
                                                        @if(optional($m->server)->serial_number)
                                                            <span class="small text-muted">— {{ \Illuminate\Support\Str::limit(optional($m->server)->serial_number, 16) }}</span>
                                                        @endif
                                                    </div>
                                                    <span class="badge badge-warning badge-priority text-uppercase">Perawatan</span>
                                                </div>
                                                <div class="announce-content small mt-1">
                                                    {{ \Illuminate\Support\Str::limit($m->treatment_type ?? 'Jadwal Perawatan', 120) }}
                                                </div>
                                                <div class="date-row mt-2">
                                                    <span class="date-chip warning start"><i class="fas fa-calendar-alt date-icon"></i><span class="date-label">Tanggal Perawatan</span><span class="date-sep">:</span><span class="date-text">{{ optional($m->treatment_date)->format('d M Y') }}</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="empty-state-maintenance">
                                    <div class="text-center py-4">
                                        <div class="empty-icon mb-3">
                                            <i class="fas fa-tools" style="font-size: 3rem; color: #e3e6f0;"></i>
                                        </div>
                                        <h6 class="text-muted mb-2">Tidak Ada Jadwal Perawatan</h6>
                                        <p class="text-muted small">Belum ada jadwal perawatan server yang terdaftar saat ini.</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Card: Lisensi akan kedaluwarsa (< 90 hari) -->
        <div class="col-xl-6 mb-4">
            <div class="card kpi-card kpi-bento indigo h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="mb-0 text-uppercase text-muted">Lisensi &amp; Tenggat</h6>
                        <div class="small text-muted">{{ now()->format('d M Y') }}</div>
                    </div>
                    <div class="announce-list">
                        <ul class="list-unstyled mb-0">
                            @forelse($lisensiExpSoon as $lic)
                                <li class="mb-3">
                                    <a href="{{ route('admin.lisensi.show', $lic->id) }}" class="announce-card accent-indigo card-click">
                                        <div class="d-flex align-items-start">
                                            <div class="announce-icon indigo mr-3"><i class="fas fa-key"></i></div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="announce-title">
                                                        {{ $lic->software_name }}
                                                        <span class="small text-muted">— {{ \Illuminate\Support\Str::limit($lic->license_key, 16) }}</span>
                                                    </div>
                                                    <span class="badge badge-indigo badge-priority text-uppercase">Lisensi</span>
                                                </div>
                                                <div class="announce-content small mt-1">
                                                    {{ \Illuminate\Support\Str::limit($lic->description ?? 'Lisensi Aplikasi', 120) }}
                                                </div>
                                                <div class="date-row mt-2">
                                                    <span class="date-chip indigo end">
                                                        <i class="fas fa-calendar-alt date-icon"></i>
                                                        <span class="date-label">Kedaluwarsa</span>
                                                        <span class="date-sep">:</span>
                                                        <span class="date-text">{{ optional($lic->expiry_date)->format('d M Y') }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="empty-state-announcement">
                                    <div class="text-center py-4">
                                        <div class="empty-icon mb-3">
                                            <i class="fas fa-hourglass-end" style="font-size: 3rem; color: #e3e6f0;"></i>
                                        </div>
                                        <h6 class="text-muted mb-2">Tidak Ada Lisensi yang Akan Kedaluwarsa</h6>
                                        <p class="text-muted small">Semua lisensi aktif memiliki masa berlaku lebih dari 90 hari ke depan.</p>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                        <div class="mt-2 small text-muted">Sudah kedaluwarsa: {{ number_format($lisensiExpired) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


</div>
@endsection