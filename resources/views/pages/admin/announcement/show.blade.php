@extends('layouts.admin')

@section('title', 'Detail Pengumuman')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pengumuman</h1>
        <a href="{{ route('admin.announcement.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    <style>
        /* Gaya preview pengumuman agar lebih cantik dan konsisten dengan Dashboard */
        .badge-priority { display: inline-flex; align-items: center; justify-content: center; min-width: 90px; text-align: center; }
        .announce-preview {
            border: 1px solid #e6ecf3;
            border-left-width: 4px;
            border-radius: 12px;
            padding: 16px;
            background: #ffffff;
            box-shadow: 0 4px 12px rgba(17,24,39,.04);
        }
        .announce-preview.accent-danger { border-left-color: #e74a3b; }
        .announce-preview.accent-warning { border-left-color: #f6c23e; }
        .announce-preview.accent-secondary { border-left-color: #858796; }
        .announce-icon {
            width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
            border: 1px solid rgba(17,24,39,.08);
        }
        .announce-icon.danger { background: rgba(231,74,59,.12); color: #e74a3b; border-color: rgba(231,74,59,.25); }
        .announce-icon.warning { background: rgba(246,194,62,.14); color: #f6c23e; border-color: rgba(246,194,62,.35); }
        .announce-icon.secondary { background: rgba(133,135,150,.12); color: #858796; border-color: rgba(133,135,150,.25); }
        .announce-title { font-weight: 700; color: #111827; }
        .announce-sub { color: #6b7280; }
        .date-row { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
        .date-chip {
            display: inline-flex; align-items: center; gap: 6px; padding: 3px 8px; border-radius: 8px; font-size: .85rem; line-height: 1.1;
            border: 1px solid rgba(17,24,39,.10); background: rgba(17,24,39,.02); color: #374151; transition: box-shadow .2s ease, background-color .15s ease, border-color .15s ease;
        }
        .date-chip .date-icon { font-size: .75em; color: #6b7280; }
        .date-chip .date-label { font-weight: 600; color: #374151; }
        .date-chip .date-sep { color: #9ca3af; }
        .date-chip .date-text { color: #374151; }
        .date-chip:hover { box-shadow: 0 6px 12px rgba(17,24,39,.07); background: rgba(17,24,39,.04); border-color: rgba(17,24,39,.16); }
        .date-chip.start .date-icon { color: #10b981; } /* hijau lembut */
        .date-chip.end .date-icon { color: #f59e0b; }   /* amber lembut */
        .content-box { border:1px solid rgba(17,24,39,.10); background:#fafbfc; border-radius:12px; padding:16px; color:#374151; line-height:1.6; }
        .meta { color:#6b7280; }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 card-soft">
                <div class="card-body">
                    @php($badge = strtolower($announcement->priority) === 'high' ? 'danger' : (strtolower($announcement->priority) === 'low' ? 'secondary' : 'warning'))
                    <div class="announce-preview accent-{{ $badge }}">
                        <div class="d-flex align-items-start">
                            <div class="announce-icon {{ $badge }} mr-3"><i class="fas fa-bullhorn"></i></div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <h4 class="announce-title mb-0">{{ $announcement->title }}</h4>
                                    <div>
                                        <span class="badge badge-{{ $badge }} badge-priority text-uppercase">{{ $announcement->priority }}</span>
                                        {!! $announcement->is_active ? '<span class="badge badge-success ml-1">Aktif</span>' : '<span class="badge badge-secondary ml-1">Nonaktif</span>' !!}
                                    </div>
                                </div>
                                <div class="announce-sub small">Detail pengumuman internal</div>

                                <div class="date-row mt-3">
                                    <span class="date-chip {{ $badge }} start"><i class="fas fa-calendar-alt date-icon"></i><span class="date-label">Mulai</span><span class="date-sep">:</span><span class="date-text">@if($announcement->start_date) {{ \Carbon\Carbon::parse($announcement->start_date)->format('d M Y') }} @else - @endif</span></span>
                                    <span class="date-chip {{ $badge }} end"><i class="fas fa-calendar-alt date-icon"></i><span class="date-label">Berakhir</span><span class="date-sep">:</span><span class="date-text">@if($announcement->end_date) {{ \Carbon\Carbon::parse($announcement->end_date)->format('d M Y') }} @else - @endif</span></span>
                                </div>

                                <div class="content-box mt-3">
                                    {!! nl2br(e($announcement->content)) !!}
                                </div>

                                <div class="meta small mt-3">
                                    Dibuat: {{ optional($announcement->created_at)->format('d M Y H:i') }}
                                    @if($announcement->updated_at && $announcement->updated_at->ne($announcement->created_at))
                                        • Diperbarui: {{ optional($announcement->updated_at)->format('d M Y H:i') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection