@extends('layouts.admin')
@section('title', 'Detail SOP')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail SOP</h1>
        <div>
            <a href="{{ route('admin.sop.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.sop.edit', $item->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated">
                <i class="fas fa-edit fa-sm mr-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi SOP</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">No SOP</th>
                                    <td>{{ $item->no_sop }}</td>
                                </tr>
                                <tr>
                                    <th>Nama SOP</th>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                <tr>
                                    <th>Versi</th>
                                    <td>{{ $item->version }}</td>
                                </tr>
                                <tr>
                                    <th>Masa Retensi</th>
                                    <td>{{ $item->retention_period }}</td>
                                </tr>
                                <tr>
                                    <th>Pemilik</th>
                                    <td>
                                        {{ optional($item->departemen)->name ?? 'Belum diatur' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Berlaku</th>
                                    <td>{{ $item->effective_date ? $item->effective_date->format('d F Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Disetujui Oleh</th>
                                    <td>{{ $item->approved_by }}</td>
                                </tr>
                                <tr>
                                    <th>File SOP</th>
                                    <td>
                                        @if($item->file)
                                            <a href="#" class="btn btn-sm btn-preview" data-toggle="modal" data-target="#filePreviewModal" data-file-url="{{ asset('storage/'.$item->file) }}"><i class="fas fa-file"></i> Lihat File</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4 summary-card">
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle text-primary mr-2"></i> Ringkasan</h6>
                    <span class="badge badge-info">SOP</span>
                </div>
                <div class="card-body p-3 summary-card-body">
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-icon bg-primary text-white"><i class="fas fa-file-alt"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">No SOP</div>
                                <div class="summary-value">{{ $item->no_sop }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-success text-white"><i class="fas fa-user"></i></div>
                                <div class="summary-content">
                                    <div class="summary-label">Pemilik</div>
                                    <div class="summary-value">{{ optional($item->departemen)->name ?? 'Belum diatur' }}</div>
                                </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-warning text-white"><i class="fas fa-calendar-alt"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Tanggal Berlaku</div>
                                <div class="summary-value">{{ $item->effective_date ? $item->effective_date->format('d F Y') : '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 900px;">
    <div class="modal-content file-preview-modal">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center">
          <i class="fas fa-file text-primary mr-2"></i>
          <div>
            <small class="text-muted" id="previewFileNameShow">-</small>
          </div>
        </div>
        <div class="ml-auto">
          <a id="openInNewTabShow" href="#" target="_blank" class="btn btn-sm btn-outline-primary mr-2"><i class="fas fa-external-link-alt"></i></a>
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal"><i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="modal-body p-0">
        <div class="file-preview-frame-wrapper">
          <iframe id="filePreviewFrameShow" src="" width="100%" height="100%" style="border:0;" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>

@section('scripts')
<style>
  .file-preview-modal { border-radius: 14px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
  .file-preview-modal .modal-header { background: #f8fafc; border-bottom: 1px solid #e9ecef; }
  .file-preview-frame-wrapper { height: 60vh; background: #fff; }
  @media (max-width: 768px) { .file-preview-frame-wrapper { height: 65vh; } }
  .summary-card .card-header { background: #f8fafc; border-bottom: 1px solid #e9ecef; }
  .summary-card-body { background: #ffffff; }
  .summary-grid { display: grid; grid-template-columns: 1fr; grid-gap: 12px; }
  .summary-item { display: flex; align-items: center; padding: 12px 14px; border: 1px solid #e9ecef; border-radius: 12px; background: #fbfdff; }
  .summary-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px; }
  .summary-label { font-size: 12px; color: #6c757d; margin-bottom: 2px; font-weight: 600; }
  .summary-value { font-size: 14px; font-weight: 600; color: #2c3e50; }
  /* prettier preview button */
  .btn-preview {
    font-size: 0.78rem;
    padding: 0.34rem 0.6rem;
    border-radius: 999px;
    color: #0d6efd;
    background: rgba(13,110,253,0.08);
    border: 1px solid rgba(13,110,253,0.15);
    box-shadow: 0 2px 8px rgba(13,110,253,0.12);
    transition: all 0.2s ease-in-out;
  }
  .btn-preview:hover {
    background: rgba(13,110,253,0.12);
    color: #0b5ed7;
    box-shadow: 0 6px 16px rgba(13,110,253,0.18);
    text-decoration: none;
  }
  .btn-preview i { font-size: 0.82rem; margin-right: 0.3rem; }
</style>
<script>
  $(function(){
    var $modal = $('#filePreviewModal');
    var $frame = $('#filePreviewFrameShow');
    var $openNew = $('#openInNewTabShow');
    var $fileName = $('#previewFileNameShow');
    $modal.on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var url = button.data('file-url');
      $frame.attr('src', url);
      $openNew.attr('href', url);
      try { var parsed = new URL(url); $fileName.text(parsed.pathname.split('/').pop()); } catch(e) { $fileName.text('File'); }
    });
  });
</script>
@endsection