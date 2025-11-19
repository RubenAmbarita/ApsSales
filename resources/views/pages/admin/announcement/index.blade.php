@extends('layouts.admin')
<link href="https://cdn.datatables.net/v/bs5/dt-2.1.0/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/r-3.0.0/datatables.min.css" rel="stylesheet">

@section('content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0">Pengumuman</h1>
  </div>
  @if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
  @endif
  <div class="card shadow mb-4 card-soft">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Daftar Pengumuman</h6>
      <div class="header-actions d-flex align-items-center">
        @if(Auth::user()->roles !== 'STAFF')
        <a href="{{ route('admin.announcement.create') }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated"><i class="fas fa-plus me-1"></i> Tambah</a>
        @endif
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive soft-table-wrapper">
        <table id="announcementTable" class="table table-hover align-middle soft-table" style="width:100%">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th>Judul</th>
              <th>Periode</th>
              <th>Prioritas</th>
              <th>Status</th>
              <th class="dt-actions text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($announcements as $a)
              <tr>
                <td class="text-center"></td>
                <td>{{ $a->title }}</td>
                <td>
                  @if($a->start_date) {{ $a->start_date->format('d M Y') }} @endif
                  -
                  @if($a->end_date) {{ $a->end_date->format('d M Y') }} @endif
                </td>
                <td><span class="badge badge-{{ $a->priority === 'high' ? 'danger' : ($a->priority === 'low' ? 'secondary' : 'warning') }}">{{ ucfirst($a->priority) }}</span></td>
                <td>{!! $a->is_active ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-secondary">Nonaktif</span>' !!}</td>
                <td class="text-center dt-actions">
                  @if(Auth::user()->roles === 'STAFF')
                    <a href="{{ route('admin.announcement.show', $a->id) }}" class="btn btn-sm btn-soft-primary btn-pill btn-elevated btn-preview" data-toggle="tooltip" data-placement="top" title="Pratinjau">
                      <i class="fas fa-eye me-2"></i>
                      <span class="btn-preview__label d-none d-md-inline">&nbsp;Pratinjau</span>
                    </a>
                  @else
                    <a href="{{ route('admin.announcement.show', $a->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Pratinjau">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.announcement.edit', $a->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit">
                      <i class="fa fa-pencil-alt"></i>
                    </a>
                    <form action="{{ route('admin.announcement.destroy', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  @endif
                </td>
              </tr>
            @empty
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- Pagination Laravel dihapus agar tidak duplikasi dengan DataTables -->
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    var table = $('#announcementTable').DataTable({
      responsive: true,
      autoWidth: false,
      dom: "<'dt-toolbar d-flex flex-wrap align-items-center justify-content-between mb-2'<'dt-length'l><'dt-search'f>>t<'dt-footer d-flex flex-wrap justify-content-between align-items-center mt-2'<'dt-info'i><'dt-pagination'p>>",
      stripeClasses: [],
      order: [],
      pageLength: 10,
      lengthMenu: [[10,25,50,100],[10,25,50,100]],
      columnDefs: [
        // 0: No, 1: Judul, 2: Periode, 3: Prioritas, 4: Status, 5: Aksi
        { targets: 0, className: 'text-center', width: '56px', orderable: false, searchable: false },
        { targets: 3, className: 'text-center text-nowrap', width: '96px' },
        { targets: 4, className: 'text-center text-nowrap', width: '96px' }
      ],
      language: {
        decimal: ",",
        thousands: ".",
        lengthMenu: "Tampilkan _MENU_ data per halaman",
        zeroRecords: "Tidak ada data ditemukan",
        info: "Menampilkan _START_ hingga _END_ dari total _TOTAL_ data",
        infoEmpty: "Menampilkan 0 hingga 0 dari total 0 data",
        infoFiltered: "(difilter dari total _MAX_ data)",
        emptyTable: "Belum ada pengumuman",
        search: "Cari:",
        loadingRecords: "Sedang memuat...",
        processing: "Sedang memuat...",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Berikutnya",
          previous: "Sebelumnya"
        }
      }
    });

    // Placeholder untuk pencarian
    $('.dataTables_filter input').attr('placeholder','Cari judul, prioritas, status...').addClass('form-control form-control-sm');

    // Inisialisasi tooltip untuk tombol aksi
    $('[data-toggle="tooltip"]').tooltip();
    function updateRowNumbers() {
      var info = table.page.info();
      table.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i){
        cell.innerHTML = info.start + i + 1;
      });
    }

    // Set nomor awal setelah inisialisasi
    updateRowNumbers();

    // Update nomor setiap kali tabel di-draw (pindah halaman, filter, dll)
    $('#announcementTable').on('draw.dt', function(){
      updateRowNumbers();

      // Re-init tooltip setiap redraw
      $('[data-toggle="tooltip"]').tooltip();
    });
  });
</script>
@endsection