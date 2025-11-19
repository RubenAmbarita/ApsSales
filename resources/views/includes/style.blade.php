<!-- Custom fonts for this template-->
    <link href="{{ url('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
     <link href="https://cdn.datatables.net/v/bs5/dt-2.1.0/b-2.4.1/b-html5-2.4.1/b-print-2.4.1/r-3.0.0/datatables.min.css" rel="stylesheet">
    <link href="{{url('backend/css/custom-sb.css')}}" rel="stylesheet">
    <link href="{{url('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <style>
    /* Typography tweaks for menus */
    .sidebar .nav-link {
        font-size: 0.95rem;
    }
    .sidebar .nav-link span {
        font-weight: 600;
        letter-spacing: 0.2px;
    }
    .sidebar-heading {
        font-size: 0.85rem;
        letter-spacing: 0.08rem;
    }
    /* Topbar and dropdown menu text */
    .topbar .navbar-nav .nav-link,
    .navbar .navbar-nav .dropdown-item,
    .dropdown-menu .dropdown-item {
        font-size: 0.95rem;
    }
    /* Compact corporate-styled user chip on topbar (rollback ke versi 2.5rem) */
    .topbar .user-chip {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .1rem .4rem; /* kembali agar pas di 2.5rem */
        line-height: 1;
        border: 1px solid var(--soft-border);
        border-radius: 999px;
        background-color: #ffffff;
        color: #0f172a;
        box-shadow: 0 2px 6px rgba(17,24,39,.05);
        transition: box-shadow .2s ease, background-color .2s ease;
    }
    .topbar .user-chip:hover { box-shadow: 0 3px 10px rgba(17,24,39,.09); background-color: #f9fbfd; text-decoration: none; }
    .topbar .user-chip__avatar {
        display: inline-flex; align-items: center; justify-content: center;
        width: 20px; height: 20px; border-radius: 50%;
        background-color: rgba(78,115,223,.12); color: #3b5ddd;
        border: 1px solid rgba(78,115,223,.30);
    }
    .topbar .user-chip__avatar i { font-size: .75rem; }
    .topbar .user-chip__name { font-size: .8rem; font-weight: 700; color: #111827; }
    .topbar .user-chip__role-badge {
        font-size: .6rem; font-weight: 800; letter-spacing: .04rem; text-transform: uppercase;
        padding: .06rem .32rem;
        border-radius: 999px; color: #3b5ddd; background-color: rgba(78,115,223,.12);
        border: 1px solid rgba(78,115,223,.30);
    }
    @media (max-width: 575.98px) {
        .topbar .user-chip { padding: .1rem .35rem; gap: .3rem; }
        .topbar .user-chip__avatar { width: 18px; height: 18px; }
        .topbar .user-chip__avatar i { font-size: .7rem; }
    }
    /* Fine-tune for small screens */
    @media (max-width: 767.98px) {
        .sidebar .nav-link {
            font-size: 0.9rem;
        }
    }
    </style>

    <!-- Topbar nav-link height adjustment per request -->
    <style>
    /* Paksa tinggi tombol/link admin di topbar kembali ke 2.5rem */
    .topbar .nav-item .nav-link {
        height: 2.5rem !important;
        display: flex;
        align-items: center;
    }
    /* Desain logout bukan kapsul: tile dengan sudut 10px dan aksen danger */
    .dropdown-menu .logout-item {
        display: flex;
        align-items: center;
        gap: .5rem;
        width: 100%;
        height: 2.5rem; /* rollback agar sejajar dengan 2.5rem */
        line-height: 1;
        padding: .3rem .75rem; /* padding halus agar total tinggi 2.5rem */
        border: 1px solid var(--soft-border);
        border-radius: 10px;
        font-weight: 600;
        background-color: #f9fbfd;
        color: #374151;
        transition: background-color .15s ease, box-shadow .15s ease, border-color .15s ease;
    }
    .dropdown-menu .logout-item i { color: #b91c1c; font-size: .9rem; }
    .dropdown-menu .logout-item:hover {
        background-color: #eef2f7; /* hover lembut selaras tema */
        border-color: var(--soft-border);
        box-shadow: 0 6px 12px rgba(17,24,39,.08);
    }
    /* Samakan tinggi tombol pada modal Logout dengan 2.5rem */
    #logoutModal .modal-footer .btn {
        min-height: 2.5rem;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .25rem .9rem;
        line-height: 1;
        font-weight: 700;
    }
    #logoutModal .modal-footer .btn i { font-size: .9rem; }

    /* (Removed: Custom sidebar overrides and variants were rolled back to restore original SB Admin 2 sidebar styling) */
    </style>

    <style>
    /* Soft theme globals for consistent UI across modules */
    :root {
      --soft-border: #e9edf5;
      --soft-muted: #6c757d;
      --primary: #4e73df;
      --teal: #11998e;
      --teal-soft: rgba(17,153,142,.12);
      --teal-border: rgba(17,153,142,.30);
      /* Shared gray tones aligned with Lisensi */
      --soft-gray-odd: #fbfdff;
      --soft-gray-even: #f8fbff;
    }
    .card-soft { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 6px 16px rgba(17, 24, 39, 0.06); }
    .btn-pill { border-radius: 999px !important; }
    .btn-elevated { box-shadow: 0 6px 14px rgba(17,24,39,.08); }
    .btn-elevated:hover { box-shadow: 0 8px 18px rgba(17,24,39,.12); }
    .btn-soft-primary { background-color: rgba(78,115,223,.12); color: #3b5ddd; border: 1px solid rgba(78,115,223,.30); }
    .btn-soft-primary:hover { background-color: rgba(78,115,223,.20); color: #2e51d1; }
    .btn-soft-teal { background-color: var(--teal-soft); color: var(--teal); border: 1px solid var(--teal-border); }
    .btn-soft-teal:hover { background-color: rgba(17,153,142,.20); color: #0f8279; }
   .btn-light-soft { background: #f9fbfd; border: 1px solid var(--soft-border); color: #374151; border-radius: 10px; }
    /* Utility: bukan kapsul, gunakan sudut 10px agar serasi dengan tile logout */
    .btn-rounded-10 { border-radius: 10px !important; }
    /* Soft danger button untuk Logout */
    .btn-soft-danger { background-color: rgba(220,53,69,.12); color: #b91c1c; border: 1px solid rgba(220,53,69,.30); }
    .btn-soft-danger:hover { background-color: rgba(220,53,69,.20); color: #9b1c1c; }
    </style>

    <!-- Sidebar Elegant Navy gradient override (subtle, premium) -->
    <style>
    /* Elegant Indigo (Corporate Blue) with Gold Top Sheen (atas) */
    #accordionSidebar.bg-gradient-primary.sidebar-dark {
      background-color: #283593 !important; /* Indigo 800 fallback */
      /* Gold Top Sheen overlay (atas) + base Elegant Indigo gradient */
      background-image:
        linear-gradient(180deg, rgba(255,206,2,0.10) 0%, rgba(255,206,2,0) 18%),
        linear-gradient(180deg, #3F51B5 0%, #1E3A8A 100%) !important; /* Indigo 500 -> Blue 800 */
      background-size: cover;
      background-repeat: no-repeat;
    }
    </style>
    <!-- Sidebar active/hover accents (gold) -->
    <style>
    /* Subtle hover for dark sidebar items */
    #accordionSidebar.sidebar-dark .nav-item .nav-link:hover {
      background-color: rgba(255,255,255,.06);
    }
    /* Active state with gold indicator */
    #accordionSidebar.sidebar-dark .nav-item.active .nav-link {
      background-color: rgba(255,255,255,.10);
      border-left: 3px solid #FFCE02;
    }
    /* Optional: gold icon on active */
    #accordionSidebar.sidebar-dark .nav-item.active .nav-link i {
      color: #FFCE02;
    }
    </style>

    <style>
    /* Stabilkan scrollbar agar halaman tidak bergeser saat tinggi konten berubah */
    html { scrollbar-gutter: stable; }
    @supports not (scrollbar-gutter: stable) {
        html { overflow-y: scroll; }
    }
    /* Opsional: pastikan container memiliki posisi relatif untuk dropdown yang di-attach */
    #filterSurface { position: relative; }
    </style>

    <style>
    /* Footer alignment fix: pastikan copyright tidak terdorong ke kanan */
    footer.sticky-footer .container { width: 100%; display: block; }
    footer.sticky-footer .copyright { text-align: center !important; }
    </style>
    
    <style>
    /* Export dropdown styling (shared across modules) */
    .export-menu { width: 280px; padding: 0; }
    .export-menu__header { display: flex; align-items: center; gap: .6rem; padding: .75rem .85rem; border-bottom: 1px solid var(--soft-border); background-color: #f8fafc; }
    .export-menu__title { font-weight: 700; color: #111827; }
    .export-item { display: flex; align-items: center; gap: .6rem; padding: .6rem .85rem; }
    .export-item:hover { background-color: #f3f4f6; }
    .export-item__icon { width: 32px; height: 32px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; }
    .bg-soft-success { background-color: #e9f7ef; color: #0b7c3e; }
    .bg-soft-danger { background-color: #fdeaea; color: #b91c1c; }
    </style>

    <style>
    /* Soft table theme (shared across modules) */
    .soft-table-wrapper { border: 1px solid var(--soft-border); border-radius: 12px; box-shadow: 0 10px 24px rgba(17,24,39,.08); padding: 8px 12px 12px; overflow-x: auto; }
.soft-table thead th { background: linear-gradient(180deg, rgba(78,115,223,.14), rgba(78,115,223,.06)); color: #0f172a; border-bottom: 2px solid var(--soft-border); }
/* Uniform base color across all rows: #ffffff */
 .soft-table { --bs-table-bg: #f8fbff; --bs-table-striped-bg: #f8fbff; --bs-table-striped-color: inherit; --bs-table-accent-bg: #f8fbff; }
 
 /* Row-level overrides (remove zebra) */
 .soft-table tbody tr.odd,
 .soft-table.table-striped > tbody > tr:nth-of-type(odd) { background-image: none !important; background-color: #f8fbff !important; }
 .soft-table tbody tr.even,
 .soft-table.table-striped > tbody > tr:nth-of-type(even) { background-image: none !important; background-color: #f8fbff !important; }
 
 /* Cell-level overrides */
 .soft-table.table-striped > tbody > tr:nth-of-type(odd) > *,
 .soft-table tbody tr.odd > * { background-image: none !important; background-color: #f8fbff !important; }
 .soft-table.table-striped > tbody > tr:nth-of-type(even) > *,
 .soft-table tbody tr.even > * { background-image: none !important; background-color: #f8fbff !important; }
 
 /* Fallback for tables not using .soft-table */
 .table-striped > tbody > tr:nth-of-type(odd) > *,
 .dataTable.stripe tbody tr.odd > * { background-color: #f8fbff !important; }
  .table-striped > tbody > tr:nth-of-type(even) > *,
  .dataTable.stripe tbody tr.even > * { background-color: #f8fbff !important; }
 
 /* Ensure all table cells use our base color */
  .soft-table > :not(caption) > * > * { background-color: #f8fbff !important; }
  
  /* Extra global overrides to defeat theme striping outside .soft-table */
  .table-striped > tbody > tr:nth-of-type(odd),
  .table-striped > tbody > tr:nth-of-type(odd) > td,
  .table-striped > tbody > tr:nth-of-type(odd) > th,
  .dataTable.stripe tbody tr.odd,
  .dataTable.stripe tbody tr.odd > td,
  .dataTable.stripe tbody tr.odd > th { background-color: #f8fbff !important; background-image: none !important; }
  
  /* Hover warna soft biru (#eaf2ff) sesuai rekomendasi */
  .soft-table.table-hover > tbody > tr:hover { background-color: #eaf2ff !important; }
  .soft-table.table-hover > tbody > tr:hover > * { background-color: #eaf2ff !important; }
  #vendorTable tbody tr:hover { background-color: #eaf2ff !important; }
  #vendorTable tbody tr:hover > * { background-color: #eaf2ff !important; }
  #locationTable tbody tr:hover { background-color: #eaf2ff !important; }
  #locationTable tbody tr:hover > * { background-color: #eaf2ff !important; }
  #departemenTable tbody tr:hover { background-color: #eaf2ff !important; }
  #departemenTable tbody tr:hover > * { background-color: #eaf2ff !important; }
  #userTable tbody tr:hover { background-color: #eaf2ff !important; }
  #userTable tbody tr:hover > * { background-color: #eaf2ff !important; }
  
  /* Responsif: hapus min-width agar tabel mengikuti lebar kontainer tanpa scroll horizontal */
  #networkTable { width: 100%; }
  /* Izinkan konten tabel membungkus jika diperlukan (kecuali kolom No yang memang diset nowrap) */
  #networkTable td, #networkTable th { white-space: normal; }
  /* Pecah kata/panjang karakter agar tidak memaksa lebar tabel melebar */
  #networkTable td { word-break: break-word; }
  /* Header judul kolom rata kiri untuk Network */
  #networkTable thead th { text-align: left !important; }
  /* Izinkan judul kolom membungkus agar tidak terpotong */
  #networkTable thead th { 
    white-space: normal !important; 
    line-height: 1.25; 
    overflow-wrap: anywhere; 
    word-break: normal; 
    padding-right: 12px; 
  }
  /* Rata kiri untuk kolom Serial Number (5) dan Tahun Produksi (6) */
  #networkTable th:nth-child(5), #networkTable td:nth-child(5),
  #networkTable th:nth-child(6), #networkTable td:nth-child(6) {
    text-align: left !important;
  }
  /* Kecilkan kolom "No" agar tidak terlalu lebar */
  #networkTable th:nth-child(1), #networkTable td:nth-child(1) { 
    width: 48px !important; 
    min-width: 48px !important; 
    max-width: 48px !important; 
    white-space: nowrap; 
    padding-left: 8px; 
    padding-right: 8px; 
  }
  /* Samakan lebar End of Sale dan End of Support */
  #networkTable th:nth-child(8), #networkTable td:nth-child(8),
  #networkTable th:nth-child(9), #networkTable td:nth-child(9) {
    width: 150px !important;
    min-width: 150px !important;
    max-width: 150px !important;
  }
  /* Beri ruang untuk Serial Number dan Tahun Produksi agar header tidak terpotong */
  #networkTable th:nth-child(6), #networkTable td:nth-child(6),
  #networkTable th:nth-child(7), #networkTable td:nth-child(7) {
    width: 140px !important;
    min-width: 140px !important;
    max-width: 140px !important;
  }
  /* Lebarkan kolom Vendor */
  #networkTable th:nth-child(5), #networkTable td:nth-child(5) {
    width: 180px !important;
    min-width: 180px !important;
    max-width: 180px !important;
  }
  /* Atur kolom Status agar rata tengah dan tidak mudah terpotong */
  #networkTable th:nth-child(10), #networkTable td:nth-child(10) {
    width: 130px !important;
    min-width: 130px !important;
    max-width: 130px !important;
    text-align: center !important;
    white-space: nowrap;
  }
  /* (hapus aturan khusus dt-actions untuk Network) */
  /* Lebar kolom Aksi agar tidak membungkus ke baris kedua */
  #networkTable th:nth-child(11), #networkTable td:nth-child(11) {
    width: 160px !important;
    min-width: 160px !important;
    max-width: 160px !important;
  }
  
  /* Empty-state: make the merged cell truly look merged (no inner borders) */
  #networkTable tbody td.dataTables_empty { 
    border: none !important; 
    background-color: #f8fbff !important; 
    text-align: center !important; 
    font-weight: 600; 
    color: var(--soft-muted);
  }
  /* Blade-rendered empty row (tidak lagi digunakan untuk Network) */
  .table-empty-row td { 
    border: none !important; 
    background-color: #f8fbff !important; 
    font-weight: 600; 
    color: var(--soft-muted);
    text-align: center; 
    vertical-align: middle;
  }
  
  /* Border dan divider lebih halus dan tidak abu-abu pekat */
  .soft-table td, .soft-table th { border-color: var(--soft-border) !important; }
  .soft-table > :not(caption) > * > * { border-color: var(--soft-border) !important; }
  /* Hilangkan garis tebal bawah baris yang bisa tampak abu-abu */
  .soft-table tbody tr { border-bottom-color: var(--soft-border) !important; }
   
   /* Ultra-specific fix for Vendor table: force white for any odd/even/striped cases */
   #vendorTable.table-striped > tbody > tr:nth-of-type(odd),
   #vendorTable.table-striped > tbody > tr:nth-of-type(odd) > td,
   #vendorTable.table-striped > tbody > tr:nth-of-type(odd) > th,
   #vendorTable.dataTable.stripe tbody tr.odd,
   #vendorTable.dataTable.stripe tbody tr.odd > td,
   #vendorTable.dataTable.stripe tbody tr.odd > th,
   #vendorTable tbody tr.odd,
   #vendorTable tbody tr.even,
   #vendorTable tbody tr > td,
   #vendorTable tbody tr > th { background-color: #f8fbff !important; background-image: none !important; }
    </style>

    <!-- Unified DataTables toolbar/footer & actions column styles -->
    <style>
      /* Fancy preview button styling for STAFF */
      .btn-preview {
        position: relative;
        transition: all .18s ease-in-out;
      }
      .btn-preview i { font-size: .9rem; }
      .btn-preview:hover { transform: translateY(-1px); }
      .btn-preview:focus { outline: none; box-shadow: 0 0 0 0.2rem rgba(78,115,223,.25); }
      /* Soft primary already defined above; reinforce readable color */
      .btn-soft-primary { font-weight: 600; }
      /* Optional subtle gradient for soft primary */
      .btn-soft-primary {
        background-image: linear-gradient(180deg, rgba(78,115,223,.14), rgba(78,115,223,.06));
      }
      .btn-soft-primary:hover {
        background-image: linear-gradient(180deg, rgba(78,115,223,.20), rgba(78,115,223,.10));
      }
      /* Compact text on small screens; show label on md+ */
      @media (max-width: 767.98px) {
        .btn-preview span { display: none !important; }
      }
      /* Toolbar & footer padding mengikuti Lisensi */
      .dt-toolbar { padding: 0 12px; }
      .dt-footer { padding: 0 12px; }

      /* Tata letak kontrol length & search */
      .dataTables_wrapper .dataTables_length label,
      .dataTables_wrapper .dataTables_filter label { display: inline-flex; align-items: center; gap: .5rem; margin: 0; }
      .dataTables_wrapper .dataTables_filter input {
        margin-left: .25rem;
        border-radius: 999px;
        padding: .35rem .75rem;
        border: 1px solid var(--soft-border);
        background-color: #ffffff;
      }
      .dataTables_wrapper .dataTables_length select {
        border-radius: 10px;
        padding: .35rem .5rem;
        border: 1px solid var(--soft-border);
        background-color: #ffffff;
      }

      /* Normalisasi gutter grid internal wrapper agar filter/pagination rata kanan/kiri tabel */
      .dataTables_wrapper .row { margin-left: 0; margin-right: 0; }
      .dataTables_wrapper .col-sm-12, .dataTables_wrapper .col-md-6 { padding-left: 0; padding-right: 0; }

      /* Kolom aksi tidak membungkus dan punya ruang kanan agar sejajar dengan filter */
      th.dt-actions, td.dt-actions { white-space: nowrap !important; }
      table.dataTable td:last-child { white-space: nowrap; padding-right: 16px; }

      /* Samakan lebar tabel dengan kontainer dan gunakan layout fixed agar tepi kanan sejajar */
      .soft-table { table-layout: fixed; }
      #towerTable { table-layout: fixed; width: 100%; }
      #locationTable { table-layout: fixed; width: 100%; }
      #userTable { table-layout: fixed; width: 100%; }
      #departemenTable { table-layout: fixed; width: 100%; }
      #vendorTable { table-layout: fixed; width: 100%; }

      /* Responsif: filter input full width di layar kecil */
      @media (max-width: 576px) {
        .dataTables_wrapper .dataTables_filter input { width: 100%; }
        .dt-toolbar, .dt-footer { gap: .5rem; }
      }
    </style>
    