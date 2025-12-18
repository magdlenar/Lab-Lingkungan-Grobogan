@extends('layouts.admin')
@section('title','Struktur Organisasi')

@section('content')

{{-- @php
  use Illuminate\Support\Facades\Storage;
@endphp --}}

<style>
/* ===================== SENADA DENGAN GALERI / AKUN TERDAFTAR ===================== */
:root{
  --g-green:#189e1e;
  --g-soft:#f0fdf4;
  --g-border:#eef1f5;
  --g-text:#0f172a;
  --g-muted:#64748b;
}

/* ===== FILTER CARD COMPACT & FIT CONTENT ===== */
.filter-card{
  background:#fff;
  padding:14px 16px;
  border-radius:18px;
  box-shadow:0 8px 20px rgba(0,0,0,.05);
  margin-bottom:18px;
  width: fit-content;
  max-width:100%;
}
.filter-form{
  display:flex;
  align-items:center;
  gap:10px;
  flex-wrap:nowrap;
}
.filter-form select,
.filter-form input{
  height:34px;
  font-size:13px;
  padding:4px 8px;
  border-radius:10px;
  white-space:nowrap;
}
.filter-form input[name="search"]{
  width:220px;
  min-width:220px;
}

/* tombol mini senada */
.btn-mini{
  height:34px;
  font-size:13px;
  padding:4px 10px;
  border-radius:10px;
  display:inline-flex;
  align-items:center;
  gap:6px;
  white-space:nowrap;
}

/* tombol tambah hijau senada */
.btn-add{
  background:#189e1e;
  color:#fff;
  border:1.5px solid #189e1e;
  transition:.2s;
}
.btn-add:hover{
  background:#1fb726;
  border-color:#1fb726;
  color:#fff;
  transform:translateY(-1px);
}

/* ===================== TABLE WRAPPER ===================== */
.modern-table-wrapper{
  background:#fff;
  border-radius:22px;
  box-shadow:0 8px 25px rgba(0,0,0,.05);
  overflow-x:auto;
  -webkit-overflow-scrolling:touch;
  width:100%;
}
.modern-table thead{ background:#f3f8ff; }
.modern-table thead th{
  padding:16px;
  font-weight:600;
  color:#40566e;
  font-size:14px;
  border-bottom:1px solid #e8eef5;
  white-space:nowrap;
}
.modern-table tbody tr:nth-child(even){ background:#f9fbfd; }
.modern-table tbody tr:hover{ background:#eef6ff; transition:.2s; }
.modern-table tbody td{
  padding:14px 16px;
  font-size:14px;
  color:#333;
  white-space:nowrap;
  vertical-align:middle;
}

/* BADGE NUMBER */
.num-badge{
  width:32px;height:32px;border-radius:50%;
  background:#eef4ff;color:#189e1e;font-weight:600;
  display:flex;align-items:center;justify-content:center;
  border:2px solid #dfe8ff;font-size:13px;
}

/* AVATAR */
.ava{
  width:44px;height:44px;border-radius:999px;
  object-fit:cover;border:2px solid #e2e8f0;
  box-shadow:0 4px 10px rgba(0,0,0,.05);
}

/* ROLE BADGE */
.badge-role{
  background:var(--g-soft);border:1px solid #bbf7d0;color:#166534;
  font-weight:900;font-size:12px;border-radius:999px;padding:4px 9px;
}

/* ACTION BUTTONS */
.action-btn{
  padding:7px 10px;
  border-radius:10px;
  font-size:13px;
  display:inline-flex;
  align-items:center;
  gap:6px;
  white-space:nowrap;
  transition:.2s;
}
.edit-btn{
  background:#eef6ff;border:1.5px solid #cfe2ff;color:#0d6efd;
}
.edit-btn:hover{
  background:#0d6efd;border-color:#0d6efd;color:#fff;transform:translateY(-1px);
}
.delete-btn{
  background:#fff1f2;border:1.5px solid #fecdd3;color:#e11d48;
}
.delete-btn:hover{
  background:#e11d48;border-color:#e11d48;color:#fff;transform:translateY(-1px);
}

/* ===== modal look clean ===== */
.modal-content{
  border-radius:16px;border:1px solid #eef1f5;
  box-shadow:0 18px 50px rgba(0,0,0,.18);
}
.modal-header{
  border-bottom:1px dashed #e5e7eb;
  background:#fff;border-top-left-radius:16px;border-top-right-radius:16px;
}

/* ===== MOBILE (senada) ===== */
@media(max-width:576px){
  .filter-card{ width:100%; max-width:100%; }
  .filter-form{
    flex-wrap:wrap;
    align-items:stretch;
    gap:8px;
    width:100%;
  }
  .filter-form input[name="search"]{
    width:100%; min-width:0; flex:1 1 100%;
  }
  .filter-form button{
    flex:1 1 calc(50% - 4px);
    justify-content:center;
  }

  /* TABLE CARD MODE */
  .modern-table thead{ display:none; }
  .modern-table tbody tr{
    display:block;
    margin-bottom:12px;
    background:#fff;
    border-radius:12px;
    padding:10px 12px;
    box-shadow:0 3px 8px rgba(0,0,0,.05);
    overflow:hidden;
  }
  .modern-table tbody td{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:10px;
    width:100%;
    white-space:normal;
    overflow-wrap:anywhere;
    word-break:break-word;
    padding:8px 6px;
    font-size:13.5px;
    border-bottom:1px solid #f0f0f0;
  }
  .modern-table tbody td:last-child{ border-bottom:none; }
  .modern-table tbody td::before{
    content:attr(data-label);
    font-weight:600;
    color:#475569;
    flex:0 0 42%;
    max-width:42%;
    overflow-wrap:anywhere;
  }
  .modern-table tbody td[data-label="Aksi"]{
    flex-direction:column;
    align-items:flex-end;
    gap:6px;
  }
}
</style>

<div class="container-fluid py-3">

  {{-- FILTER / TOOLBAR CARD --}}
  <div class="filter-card">
    <form method="GET" class="filter-form">
      <input type="text" name="search"
             class="form-control form-control-sm"
             placeholder="Cari jabatan / nama..."
             value="{{ request('search') }}">

      <button class="btn btn-success btn-mini">
        <i class="bi bi-search"></i> Cari
      </button>

      <button type="button" class="btn btn-add btn-mini"
              data-bs-toggle="modal"
              data-bs-target="#addModal">
        <i class="bi bi-plus-circle"></i> Tambah Personel
      </button>
    </form>

    @if(session('success'))
      <div class="alert alert-success mt-3 mb-0">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger mt-3 mb-0">
        {{ $errors->first() }}
      </div>
    @endif
  </div>

  {{-- TABLE LIST --}}
  <div class="modern-table-wrapper">
    <table class="table modern-table align-middle mb-0">
      <thead>
        <tr>
          <th style="width:60px;">No</th>
          <th style="width:90px;">Foto</th>
          <th>Jabatan</th>
          <th>Nama</th>
          <th>Parent (Atasan)</th>
          <th style="width:90px;">Urutan</th>
          <th style="width:220px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $i)
        <tr>
          <td data-label="No">
            @php
              $startNumber = method_exists($items, 'currentPage')
                  ? ($items->currentPage() - 1) * $items->perPage()
                  : 0;
            @endphp
            <div class="num-badge">
              {{ $loop->iteration + $startNumber }}
            </div>
          </td>

          <td data-label="Foto">
          <img class="ava" src="{{ asset('images/default-user.png') }}" alt="foto">
        </td>

          <td data-label="Jabatan">
            <span class="badge-role">{{ $i->jabatan }}</span>
          </td>

          <td data-label="Nama" class="fw-semibold">
            {{ $i->nama }}
          </td>

          <td data-label="Parent">
            {{ optional($i->parent)->nama ?? '-' }}
          </td>

          <td data-label="Urutan">
            {{ $i->urutan }}
          </td>

          <td data-label="Aksi">
            <div class="d-flex gap-2 flex-wrap justify-content-end">
              <button class="btn action-btn edit-btn"
                      data-bs-toggle="modal"
                      data-bs-target="#edit{{ $i->id }}">
                <i class="bi bi-pencil-square"></i> Edit
              </button>

              <button class="btn action-btn delete-btn"
                      data-bs-toggle="modal"
                      data-bs-target="#delete{{ $i->id }}">
                <i class="bi bi-trash"></i> Hapus
              </button>
            </div>
          </td>
        </tr>

        {{-- EDIT MODAL --}}
        <div class="modal fade" id="edit{{ $i->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <form method="POST" action="{{ route('admin.struktur.update',$i->id) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                  <h5 class="modal-title fw-bold">Edit Personel</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <div class="row g-3">
                   @php
                    $jabatanOptions = [
                      'Manajer Puncak',
                      'Manajer Mutu',
                      'Manajer Teknis',
                      'Manajer Administrasi',
                      'Staf Mutu',
                      'Penyelia',
                      'Petugas K3L',
                      'Penerima Contoh Uji',
                      'Staf Administrasi',
                      'Analis',
                      'Petugas Sampling',
                    ];

                    $isCustomEdit = !in_array($i->jabatan, $jabatanOptions, true);
                  @endphp

                  <div class="col-md-6">
                    <label class="form-label fw-semibold">Jabatan</label>

                    <select name="jabatan_select"
                            id="jabatanSelectEdit{{ $i->id }}"
                            class="form-select"
                            required
                            onchange="toggleJabatanManualEdit('{{ $i->id }}', this.value)">
                      <option value="">-- Pilih Jabatan --</option>

                      @foreach($jabatanOptions as $j)
                        <option value="{{ $j }}" @selected(!$isCustomEdit && $i->jabatan === $j)>
                          {{ $j }}
                        </option>
                      @endforeach

                      <option value="__custom__" @selected($isCustomEdit)>
                        ➕ Jabatan Lainnya (Manual)
                      </option>
                    </select>

                    <div class="mt-2 {{ $isCustomEdit ? '' : 'd-none' }}" id="jabatanManualWrapEdit{{ $i->id }}">
                      <input type="text"
                            name="jabatan_manual"
                            class="form-control"
                            placeholder="Masukkan nama jabatan baru">
                      <small class="text-muted">Gunakan jika jabatan belum ada di daftar</small>
                    </div>
                  </div>

                    <div class="col-md-6">
                      <label class="form-label fw-semibold">Nama</label>
                      <input name="nama" class="form-control" value="{{ $i->nama }}" required>
                    </div>

                    <div class="col-md-6">
                      <label class="form-label fw-semibold">Atasan (Parent)</label>
                      <select name="parent_id" class="form-select">
                        <option value="">- Tidak ada -</option>
                        @foreach($parents as $p)
                          <option value="{{ $p->id }}" @selected($i->parent_id==$p->id)>
                            {{ $p->jabatan }} — {{ $p->nama }}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <div class="col-md-3">
                      <label class="form-label fw-semibold">Urutan</label>
                      <input type="number" name="urutan" class="form-control" value="{{ $i->urutan }}">
                      <div class="small text-muted mt-1">Semakin kecil, semakin atas.</div>
                    </div>

                    <div class="col-md-3">
                      <label class="form-label fw-semibold">Foto (opsional)</label>
                    
                      {{-- <input type="file" name="foto" class="form-control"> --}}
                      {{-- @if($i->foto)
                          <img src="..." class="ava mt-2" alt="current">
                      @endif --}}
                    
                      <div class="text-muted small">Fitur foto dinonaktifkan.</div>
                    </div>

                <div class="modal-footer">
                  <button class="btn btn-success w-100" style="border-radius:12px;font-weight:800;">
                    <i class="bi bi-save me-1"></i> Simpan
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        {{-- DELETE MODAL --}}
        <div class="modal fade" id="delete{{ $i->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="POST" action="{{ route('admin.struktur.destroy',$i->id) }}">
                @csrf @method('DELETE')
                <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title fw-bold">Hapus Personel</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  Yakin hapus <b>{{ $i->nama }}</b> ({{ $i->jabatan }}) ?
                  <div class="alert alert-warning small mt-2" style="border-radius:10px;">
                    Tindakan ini tidak dapat dibatalkan.
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                          style="border-radius:10px;font-weight:700;">Batal</button>
                  <button type="submit" class="btn btn-danger"
                          style="border-radius:10px;font-weight:800;">Hapus</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        @empty
        <tr>
          <td colspan="7" class="text-center text-muted py-4">
            Belum ada data struktur organisasi.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- PAGINATION --}}
 @if(method_exists($items, 'hasPages') && $items->hasPages())
  <div class="mt-3 pagination-modern-wrap">
    {{ $items->appends(request()->query())->links('pagination::bootstrap-5') }}
  </div>
@endif

</div>

{{-- ADD MODAL --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <form method="POST" action="{{ route('admin.struktur.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title fw-bold">
            <i class="bi bi-diagram-3-fill text-success me-1"></i> Tambah Personel
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-semibold">Jabatan</label>
              <select name="jabatan_select"
                  id="jabatanSelect"
                  class="form-select"
                  required
                  onchange="toggleJabatanManual(this.value)">
              <option value="">-- Pilih Jabatan --</option>

              {{-- LEVEL ATAS --}}
              <option value="Manajer Puncak">Manajer Puncak</option>

              {{-- LEVEL MANAJER --}}
              <option value="Manajer Mutu">Manajer Mutu</option>
              <option value="Manajer Teknis">Manajer Teknis</option>
              <option value="Manajer Administrasi">Manajer Administrasi</option>

              {{-- LEVEL STAF / OPERASIONAL --}}
              <option value="Staf Mutu">Staf Mutu</option>
              <option value="Penyelia">Penyelia</option>
              <option value="Analis">Analis</option>
              <option value="Petugas Sampling">Petugas Sampling</option>
              <option value="Petugas K3L">Petugas K3L</option>
              <option value="Penerima Contoh Uji">Penerima Contoh Uji</option>
              <option value="Staf Administrasi">Staf Administrasi</option>

              {{-- MANUAL --}}
              <option value="__custom__">➕ Jabatan Lainnya (Manual)</option>
                    </select>
                      </div>
                      <div class="mt-2 d-none" id="jabatanManualWrap">
                {{-- ✅ aku tambahin id biar JS gak error --}}
                <input type="text"
                      id="jabatanManualInput"
                      name="jabatan_manual"
                      class="form-control"
                      placeholder="Masukkan nama jabatan baru">
              <small class="text-muted">
                  Gunakan jika jabatan belum ada di daftar
              </small>
          </div>


            <div class="col-md-6">
              <label class="form-label fw-semibold">Nama</label>
              <input name="nama" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-semibold">Atasan (Parent)</label>
              <select name="parent_id" class="form-select">
                <option value="">- Tidak ada -</option>
                @foreach($parents as $p)
                  <option value="{{ $p->id }}">{{ $p->jabatan }} — {{ $p->nama }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-3">
              <label class="form-label fw-semibold">Urutan</label>
              <input type="number" name="urutan" class="form-control" value="0">
              <div class="small text-muted mt-1">Semakin kecil, semakin atas.</div>
            </div>

            <div class="col-md-3">
          <label class="form-label fw-semibold">Foto (opsional)</label>
          {{-- <input type="file" name="foto" class="form-control"> --}}
          <div class="text-muted small">Fitur foto dinonaktifkan.</div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-success w-100" style="border-radius:12px;font-weight:800;">
            <i class="bi bi-plus-circle me-1"></i> Simpan Data
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
function toggleJabatanManual(value) {
  const wrap = document.getElementById('jabatanManualWrap');
  const input = document.getElementById('jabatanManualInput');

  if (value === '__custom__') {
    wrap.classList.remove('d-none');
    input.required = true;
  } else {
    wrap.classList.add('d-none');
    input.required = false;
    input.value = '';
  }
}
function toggleJabatanManualEdit(id, value) {
  const wrap = document.getElementById('jabatanManualWrapEdit' + id);
  if (!wrap) return;

  if (value === '__custom__') {
    wrap.classList.remove('d-none');
  } else {
    wrap.classList.add('d-none');
    // optional: kosongkan input manual kalau balik ke pilihan list
    const input = wrap.querySelector('input[name="jabatan_manual"]');
    if (input) input.value = '';
  }
}
</script>
@endsection
