@extends('layouts.admin')
@section('title', 'Detail Lisensi')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Lisensi</h1>
        <div>
            <a href="{{ route('admin.lisensi.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
            <a href="{{ route('admin.lisensi.edit', $item->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated">
                <i class="fas fa-edit fa-sm mr-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Lisensi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Vendor</th>
                                    <td>{{ $item->vendor ? $item->vendor->name : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Software</th>
                                    <td>{{ $item->software_name }}</td>
                                </tr>
                                <tr>
                                    <th>Fungsi</th>
                                    <td>{{ $item->function }}</td>
                                </tr>
                                <tr>
                                    <th>License Key</th>
                                    <td><code>{{ $item->license_key }}</code></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Seat</th>
                                    <td>{{ $item->seats }}</td>
                                </tr>
                                <tr>
                                    <th>Masa Berlaku</th>
                                    <td>
                                        {{ $item->start_date ? $item->start_date->format('d F Y') : '-' }} - 
                                        {{ $item->expiry_date ? $item->expiry_date->format('d F Y') : '-' }}
                                        @php($daysLeft = $item->expiry_date ? now()->diffInDays($item->expiry_date, false) : null)
                                        <div class="mt-2">
                                            @if(!is_null($daysLeft) && $daysLeft > 0)
                                                <span class="badge {{ $daysLeft<=30 ? 'badge-warning' : 'badge-success' }}">
                                                    {{ $daysLeft.' hari lagi' }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ditugaskan ke</th>
                                    <td>{{ $item->assigned_to ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $item->status }}</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>{{ $item->description }}</td>
                                </tr>
                                <tr>
                                    <th>File Lisensi</th>
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
                    @php($statusClass = $item->status === 'Aktif' ? 'badge-success' : ($item->status === 'Kadaluarsa' ? 'badge-danger' : 'badge-secondary'))
                    <span class="badge {{ $statusClass }}">{{ $item->status }}</span>
                </div>
                <div class="card-body p-3 summary-card-body">
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-icon bg-primary text-white"><i class="fas fa-building"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Vendor</div>
                                <div class="summary-value">{{ $item->vendor ? $item->vendor->name : '-' }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-info text-white"><i class="fas fa-key"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">License Key</div>
                                <div class="summary-value d-flex align-items-center">
                                    <code id="licenseKeyText">{{ Str::limit($item->license_key, 20) }}</code>
                                    <button type="button" class="btn btn-sm btn-light ml-2" id="copyLicenseKey" data-key="{{ $item->license_key }}">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-success text-white"><i class="fas fa-user"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Ditugaskan ke</div>
                                <div class="summary-value">{{ $item->assigned_to ?: '-' }}</div>
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-icon bg-warning text-white"><i class="fas fa-calendar-alt"></i></div>
                            <div class="summary-content">
                                <div class="summary-label">Masa Berlaku</div>
                                <div class="summary-value">
                                    {{ $item->start_date ? $item->start_date->format('d F Y') : '-' }} -
                                    {{ $item->expiry_date ? $item->expiry_date->format('d F Y') : '-' }}
                                    @php($daysLeftSummary = $item->expiry_date ? now()->diffInDays($item->expiry_date, false) : null)
                                    @if(!is_null($daysLeftSummary) && $daysLeftSummary > 0)
                                        <span class="badge ml-2 {{ $daysLeftSummary<=30 ? 'badge-warning' : 'badge-success' }}">
                                            {{ $daysLeftSummary.' hari lagi' }}
                                        </span>
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

<!-- Modal Pratinjau File (lebih kecil & rapi) -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="max-width: 900px;">
    <div class="modal-content file-preview-modal">
      <div class="modal-header align-items-center">
        <div class="d-flex align-items-center">
          <i class="fas fa-file text-primary mr-2"></i>
          <div>
            <!-- Judul pratinjau dihilangkan sesuai permintaan -->
            <small class="text-muted" id="previewFileNameShow">-</small>
          </div>
        </div>
        <div class="ml-auto">
          <a id="openInNewTabShow" href="#" target="_blank" class="btn btn-sm btn-outline-primary mr-2" aria-label="Buka di tab baru" title="Buka di tab baru"><i class="fas fa-external-link-alt"></i></a>
          <button type="button" class="btn btn-sm btn-light" data-dismiss="modal" aria-label="Tutup" title="Tutup"><i class="fas fa-times"></i></button>
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
  /* Summary card styling */
  .summary-card .card-header { background: #f8fafc; border-bottom: 1px solid #e9ecef; }
  .summary-card-body { background: #ffffff; }
  .summary-grid { display: grid; grid-template-columns: 1fr; grid-gap: 12px; }
  @media (min-width: 576px) { .summary-grid { grid-template-columns: 1fr; } }
  @media (min-width: 768px) { .summary-grid { grid-template-columns: 1fr; } }
  @media (min-width: 992px) { .summary-grid { grid-template-columns: 1fr; } }
  .summary-item { display: flex; align-items: center; padding: 12px 14px; border: 1px solid #e9ecef; border-radius: 12px; background: #fbfdff; }
  .summary-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px; box-shadow: inset 0 0 0 1px rgba(255,255,255,0.3); }
  .summary-label { font-size: 12px; color: #6c757d; margin-bottom: 2px; font-weight: 600; letter-spacing: .2px; }
  .summary-value { font-size: 14px; font-weight: 600; color: #2c3e50; }
  #copyLicenseKey { padding: 4px 8px; }
  :root { --teal: #11998e; --teal-soft: rgba(17,153,142,.12); --teal-border: rgba(17,153,142,.30); }
  .btn-pill { border-radius: 999px !important; }
  .btn-elevated { box-shadow: 0 6px 14px rgba(17,24,39,.08); }
  .btn-elevated:hover { box-shadow: 0 8px 18px rgba(17,24,39,.12); }
  .btn-soft-primary { background-color: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.30); }
  .btn-soft-primary:hover { background-color: rgba(78,115,223,.20); color: #2e51d1; }
  .btn-soft-teal { background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal-border); }
  .btn-soft-teal:hover { background-color: rgba(17,153,142,.20); color: #0f8279; }
  /* Preview button style to match SOP */
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
      try {
        var name = (url || '').split('/').pop();
        $fileName.text(name || 'File');
      } catch (e) { $fileName.text('File'); }
    });

    $modal.on('hidden.bs.modal', function(){
      $frame.attr('src','');
      $openNew.attr('href','#');
      $fileName.text('-');
    });
  });
</script>
<script>
  // Copy license key interaction with quick feedback
  $(function(){
    var $btn = $('#copyLicenseKey');
    if($btn.length){
      $btn.on('click', async function(){
        var key = $(this).data('key');
        try {
          await navigator.clipboard.writeText(key);
          var $icon = $(this).find('i');
          var originalClass = $icon.attr('class');
          $icon.attr('class','fas fa-check text-success');
          $(this).addClass('btn-success');
          setTimeout(function(){
            $icon.attr('class', originalClass);
            $btn.removeClass('btn-success');
          }, 1200);
        } catch(err) {
          // Fallback: create a temp input
          var $temp = $('<input>');
          $('body').append($temp);
          $temp.val(key).select();
          document.execCommand('copy');
          $temp.remove();
        }
      });
    }
  });
</script>
@endsection