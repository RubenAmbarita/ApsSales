@extends('layouts.admin')

@section('title', 'Edit Jadwal Perawatan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Jadwal Perawatan</h1>
        <a href="{{ route('admin.riwayatperawatan.index') }}" class="btn btn-sm btn-soft-teal btn-pill btn-elevated">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Jadwal Perawatan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.riwayatperawatan.update', $item->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="id_server">Server</label>
                    <select name="id_server" id="id_server" class="tom-select" required>
                        @foreach($servers as $srv)
                        <option 
                            value="{{ $srv->id }}" 
                            data-brand="{{ $srv->brand }}" 
                            data-model="{{ $srv->model }}" 
                            data-sn="{{ $srv->serial_number }}" 
                            {{ $item->id_server == $srv->id ? 'selected' : '' }}>
                            {{ $srv->brand }} {{ $srv->model }} (SN {{ $srv->serial_number }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="treatment_date">Tanggal Perawatan</label>
                    <input type="date" name="treatment_date" id="treatment_date" class="form-control" value="{{ optional($item->treatment_date)->format('Y-m-d') }}" required>
                </div>
                <div class="form-group">
                    <label for="treatment_type">Tipe Perawatan</label>
                    <input type="text" name="treatment_type" id="treatment_type" class="form-control" value="{{ $item->treatment_type }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" rows="3" class="form-control">{{ $item->description }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cost">Biaya</label>
                        <input type="text" name="cost" id="cost" class="form-control" value="{{ $item->cost }}" placeholder="Contoh: Rp 1.500.000" inputmode="numeric" autocomplete="off">
                        <small class="text-muted">Format otomatis Rupiah. Nilai yang dikirim akan berupa angka murni.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="long_warranty">Masa Garansi (opsional)</label>
                        <input type="text" name="long_warranty" id="long_warranty" class="form-control" value="{{ $item->long_warranty }}">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-soft-primary btn-elevated btn-pill">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
 </div>

<script>
document.addEventListener('DOMContentLoaded', function(){
  var input = document.getElementById('cost');
  if(!input) return;

  function formatRupiah(val){
    var digits = (val || '').toString().replace(/[^0-9]/g,'');
    if(!digits) return '';
    return 'Rp ' + digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  function applyFormat(){
    input.value = formatRupiah(input.value);
  }

  // Format nilai awal jika ada
  applyFormat();
  // Format saat mengetik
  input.addEventListener('input', function(){
    applyFormat();
    try { input.setSelectionRange(input.value.length, input.value.length); } catch(e) {}
  });

  // Saat submit, kirim angka murni tanpa Rp/titik
  var form = input.closest('form');
  if(form){
    form.addEventListener('submit', function(){
      var raw = (input.value || '').toString().replace(/[^0-9]/g,'');
      input.value = raw;
    });
  }
});
</script>

<!-- Searchable dropdown for Server using Tom Select (no jQuery required) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css">
<style>
/* Percantik Tom Select agar seragam dengan Bootstrap form-control */
.tom-select.ts-wrapper{ display:block; width:100%; }
.tom-select .ts-control{ min-height:38px; padding:.375rem .75rem; border:1px solid #e3e6f0; border-radius:.35rem; background:#fff; box-shadow:none; }
.tom-select .ts-control.focus{ border-color:#6366f1; box-shadow:0 0 0 .2rem rgba(99,102,241,.15); }
.tom-select .ts-dropdown{ border:1px solid #e3e6f0; border-radius:.5rem; box-shadow:0 12px 20px rgba(17,24,39,.08); }
.tom-select .option{ padding:.35rem .5rem; }
.tom-select .item{ margin-right:.25rem; }
.tom-select .clear-button{ color:#9ca3af; }
.tom-select .clear-button:hover{ color:#4b5563; }
/* Formatting for option two-line layout */
.tom-select .ts-dropdown .option .option-title{ font-weight:600; color:#111827; }
.tom-select .ts-dropdown .option .option-meta{ font-size:.78rem; color:#6b7280; }
.tom-select .ts-control .item .item-title{ font-weight:600; color:#111827; }
.tom-select .ts-control .item .item-meta{ font-size:.78rem; color:#6b7280; margin-left:.25rem; }
</style>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var serverSelect = document.getElementById('id_server');
  if(serverSelect){
    var ts = new TomSelect(serverSelect, {
      create: false,
      allowEmptyOption: false,
      placeholder: 'Cari server…',
      maxOptions: 1000,
      searchField: ['brand','model','sn','text'],
      sortField: [{field:'text',direction:'asc'}],
      plugins: ['clear_button'],
      render: {
        option: function(data, escape){
          var brand = escape(data.brand || '');
          var model = escape(data.model || '');
          var sn    = escape(data.sn || '');
          return '<div class="d-flex flex-column">'
               +   '<div class="option-title">' + brand + ' ' + model + '</div>'
               +   '<div class="option-meta">SN: ' + sn + '</div>'
               + '</div>';
        },
        item: function(data, escape){
          var brand = escape(data.brand || '');
          var model = escape(data.model || '');
          var sn    = escape(data.sn || '');
          return '<div class="d-inline-flex align-items-center">'
               +   '<span class="item-title">' + brand + ' ' + model + '</span>'
               +   '<span class="item-meta">(SN ' + sn + ')</span>'
               + '</div>';
        }
      }
    });
  }
});
</script>
@endsection