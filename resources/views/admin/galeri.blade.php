@extends('layouts.admin')
@section('title','Galeri')

@php
  use Illuminate\Support\Facades\Storage;
  use Illuminate\Support\Str;
@endphp

@section('content')

<style>
/* ===================== SENADA DENGAN AKUN TERDAFTAR ===================== */

/* ===== FILTER CARD COMPACT & FIT CONTENT ===== */
.filter-card{
    background:#fff;
    padding:14px 16px;
    border-radius:18px;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
    margin-bottom:18px;
    width: fit-content;
    max-width: 100%;
}

/* ===== HORIZONTAL FORM ===== */
.filter-form{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:nowrap;
}

/* ukuran kompak input/select */
.filter-form select,
.filter-form input{
    height:34px;
    font-size:13px;
    padding:4px 8px;
    border-radius:10px;
    white-space:nowrap;
}

/* search kecil */
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
.modern-table tbody tr:hover{ background:#eef6ff;transition:.2s; }
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

/* THUMB */
.thumb{
    width:100px;height:64px;object-fit:cover;border-radius:12px;border:1px solid #eee;
    box-shadow:0 4px 10px rgba(0,0,0,.05);
}

/* TAG CHIP */
.tag{
    display:inline-block;background:#f0fdf4;color:#166534;
    border:1px solid #bbf7d0;border-radius:999px;
    padding:2px 8px;font-size:11.5px;font-weight:700;margin:2px 2px;
    white-space:nowrap;
}

/* ACTION BUTTONS (senada permintaan/akun) */
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

/* Edit */
.edit-btn{
    background:#eef6ff;
    border:1.5px solid #cfe2ff;
    color:#0d6efd;
}
.edit-btn:hover{
    background:#0d6efd;
    border-color:#0d6efd;
    color:#fff;
    transform:translateY(-1px);
}

/* Komentar */
.comment-btn{
    background:#f8fafc;
    border:1.5px solid #e2e8f0;
    color:#0f172a;
}
.comment-btn:hover{
    background:#0f172a;
    border-color:#0f172a;
    color:#fff;
    transform:translateY(-1px);
}

/* Delete senada akun */
.delete-btn{
    background:#fff1f2;
    border:1.5px solid #fecdd3;
    color:#e11d48;
}
.delete-btn:hover{
    background:#e11d48;
    border-color:#e11d48;
    color:#fff;
    transform:translateY(-1px);
}

/* ===================== PAGINATION MODERN (FIX UKURAN) ===================== */
.pagination-modern-wrap nav{
    display:flex;
    justify-content:center;
}
.pagination-modern-wrap .pagination{
    gap:6px;
    padding:6px 10px;
    background:#fff;
    border-radius:999px;
    box-shadow:0 6px 18px rgba(0,0,0,.06);
    border:1px solid #eef1f5;
}

.pagination-modern-wrap .page-link{
    width:32px;height:32px;
    display:flex;align-items:center;justify-content:center;
    font-size:13px;
    background:#f1f5f9;
    border:none;
    color:#475569;
    font-weight:700;
    border-radius:10px !important;
    transition:.18s;
}
.pagination-modern-wrap .page-link:hover{
    background:#e2e8f0;
    transform:translateY(-1px);
}

.pagination-modern-wrap .page-item.active .page-link{
    background:#189e1e !important;
    color:#fff !important;
    box-shadow:0 4px 10px rgba(24,158,30,.25);
}

/* Prev/Next jadi pill kecil */
.pagination-modern-wrap .page-item:first-child .page-link,
.pagination-modern-wrap .page-item:last-child .page-link{
    width:auto;height:32px;
    padding:0 12px;
    border-radius:999px !important;
    font-weight:800;
}

/* disable look lebih soft */
.pagination-modern-wrap .page-item.disabled .page-link{
    opacity:.5;
    background:#f8fafc;
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

/* ===== comment list ===== */
.comment-item{
    border:1px solid #eef1f5;border-radius:12px;padding:10px 12px;
    background:#fff;display:flex;justify-content:space-between;gap:10px;align-items:flex-start;
    flex-wrap:wrap;
}
.comment-left{ flex:1; min-width:220px; }
.comment-name{ font-weight:800;color:#0f172a;font-size:13.5px; }
.comment-text{ font-size:13.5px;color:#334155;white-space:pre-wrap; }
.comment-date{ font-size:11.5px;color:#94a3b8; }

/* ================= CKEDITOR + MODAL SCROLL FIX ================= */

/* ✅ modal body tetap bisa scroll walau editor panjang */
.modal-dialog-scrollable .modal-body{
    max-height: calc(100vh - 210px); /* header + footer */
    overflow-y:auto;
}

/* ✅ editor jangan bikin modal kepanjangan (scroll di dalam editor) */
.modal-dialog-scrollable .ck-editor__editable{
    min-height:200px;
    max-height:320px;  /* batas tinggi editor */
    overflow-y:auto;
    border-radius:10px;
}

/* toolbar & border lebih rapi */
.modal-dialog-scrollable .ck.ck-toolbar{
    border-radius:10px 10px 0 0 !important;
}
.modal-dialog-scrollable .ck-editor__main{
    border-radius:0 0 10px 10px !important;
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
        width:100%;
        min-width:0;
        flex:1 1 100%;
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

    .thumb{ width:92px; height:58px; }

    /* pagination tidak kebesaran di HP */
    .pagination-modern-wrap .pagination{
        flex-wrap:wrap;
        border-radius:16px;
        padding:8px;
        gap:5px;
    }
}
</style>

<div class="container-fluid py-3">

    {{-- FILTER / TOOLBAR CARD --}}
    <div class="filter-card">
        <form method="GET" class="filter-form">
            <input type="text" name="search"
                   class="form-control form-control-sm"
                   placeholder="Cari judul / tagar..."
                   value="{{ $search }}">

            <button class="btn btn-success btn-mini">
                <i class="bi bi-search"></i> Cari
            </button>

            <button type="button" class="btn btn-add btn-mini"
                    data-bs-toggle="modal"
                    data-bs-target="#addGaleriModal">
                <i class="bi bi-plus-circle"></i> Tambah Artikel
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
                    <th style="width:130px;">Gambar</th>
                    <th>Judul & Ringkas</th>
                    <th>Tagar</th>
                    <th style="width:170px;">Terbit</th>
                    <th style="width:260px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($galeris as $g)
                <tr>
                    <td data-label="No">
                        <div class="num-badge">
                            {{ $loop->iteration + ($galeris->currentPage()-1)*$galeris->perPage() }}
                        </div>
                    </td>

                    <td data-label="Gambar">
                        @php
                          $imgUrl = null;
                          if ($g->gambar) {
                            $imgUrl = Str::startsWith($g->gambar, ['http://','https://'])
                              ? $g->gambar
                              : Storage::disk('public')->url($g->gambar); // hasil: /storage/....
                          }
                        @endphp
                        
                        @if($imgUrl)
                          <img src="{{ $imgUrl }}" class="thumb" alt="thumb">
                        @else
                          <div class="text-muted small">Tidak ada gambar</div>
                        @endif
                    </td>

                    <td data-label="Judul">
                        <div class="fw-semibold">{{ $g->judul }}</div>
                        <div class="text-muted small mt-1">
                            {{ \Illuminate\Support\Str::limit(strip_tags($g->deskripsi), 110) }}
                        </div>
                    </td>

                    <td data-label="Tagar">
                        @foreach($g->tag_array as $t)
                            <span class="tag">#{{ $t }}</span>
                        @endforeach
                    </td>

                    <td data-label="Terbit">
                        {{ $g->created_at->timezone('Asia/Jakarta')->translatedFormat('d F Y') }}
                        <div class="text-muted small">
                            {{ $g->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
                        </div>
                    </td>

                    <td data-label="Aksi">
                        <div class="d-flex gap-2 flex-wrap justify-content-end">
                            <button class="btn action-btn edit-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $g->id }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>

                            <button class="btn action-btn comment-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#commentModal{{ $g->id }}">
                                <i class="bi bi-chat-dots"></i>
                                Komentar ({{ $g->comments_count ?? ($g->comments->count() ?? 0) }})
                            </button>

                            <button class="btn action-btn delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $g->id }}">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </td>
                </tr>

                {{-- MODAL EDIT --}}
                <div class="modal fade" id="editModal{{ $g->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.galeri.update', $g->id) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Artikel</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Judul</label>
                                            <input type="text" name="judul" class="form-control"
                                                   value="{{ $g->judul }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Ganti Gambar</label>
                                            <input type="file" name="gambar" class="form-control">
                                            @if($g->gambar)
                                              @php
                                                $currentImg = Str::startsWith($g->gambar, ['http://','https://'])
                                                  ? $g->gambar
                                                  : Storage::disk('public')->url($g->gambar);
                                              @endphp
                                              <img src="{{ $currentImg }}" class="thumb mt-2" alt="current">
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Deskripsi</label>
                                            {{-- ✅ rich editor --}}
                                            <textarea name="deskripsi"
                                                      class="form-control rich-desc"
                                                      required>{!! $g->deskripsi !!}</textarea>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Tagar</label>
                                            <input type="text" name="tagar" class="form-control"
                                                   value="{{ $g->tagar }}"
                                                   placeholder="contoh: edukasi, kunjungan, pelatihan">
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-success w-100"
                                            style="border-radius:12px;font-weight:800;">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- MODAL KOMENTAR --}}
                <div class="modal fade" id="commentModal{{ $g->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title fw-bold mb-0">Komentar Pembaca</h5>
                                    <div class="text-muted small">Artikel: <b>{{ $g->judul }}</b></div>
                                </div>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                @php $comments = $g->comments ?? collect(); @endphp

                                @if($comments->count())
                                    <div class="d-flex flex-column gap-2">
                                        @foreach($comments as $c)
                                            <div class="comment-item">
                                                <div class="comment-left">
                                                    <div class="comment-name">
                                                        {{ $c->nama ?? $c->name ?? 'Anonim' }}
                                                    </div>
                                                    <div class="comment-text mt-1">
                                                        {{ $c->komentar ?? $c->comment ?? '-' }}
                                                    </div>
                                                    <div class="comment-date mt-1">
                                                        {{ optional($c->created_at)->format('d M Y, H:i') }}
                                                    </div>
                                                </div>

                                                <form method="POST"
                                                      action="{{ route('admin.galeri.comment.destroy', $c->id) }}"
                                                      onsubmit="return confirm('Hapus komentar ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-outline-danger"
                                                            style="border-radius:10px;font-weight:700;">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center text-muted py-4">
                                        Belum ada komentar untuk artikel ini.
                                    </div>
                                @endif
                            </div>

                            <div class="modal-footer">
                                <button class="btn btn-secondary w-100" data-bs-dismiss="modal"
                                        style="border-radius:12px;font-weight:800;">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MODAL DELETE --}}
                <div class="modal fade" id="deleteModal{{ $g->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.galeri.destroy', $g->id) }}">
                                @csrf
                                @method('DELETE')

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title fw-bold">Hapus Artikel</h5>
                                    <button type="button" class="btn-close btn-close-white"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    Yakin hapus artikel <b>{{ $g->judul }}</b>?
                                    <div class="alert alert-warning small mt-2" style="border-radius:10px;">
                                        Tindakan ini tidak dapat dibatalkan.
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal"
                                            style="border-radius:10px;font-weight:700;">
                                        Batal
                                    </button>

                                    <button type="submit" class="btn btn-danger"
                                            style="border-radius:10px;font-weight:800;">
                                        Hapus
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
                        Belum ada artikel galeri.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($galeris->hasPages())
        <div class="mt-3 pagination-modern-wrap">
            {{ $galeris->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>

{{-- MODAL TAMBAH ARTIKEL --}}
<div class="modal fade" id="addGaleriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-images text-success me-1"></i> Tambah Artikel Galeri
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Judul Artikel</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Gambar (opsional)</label>
                            <input type="file" name="gambar" class="form-control">
                            <small class="text-muted">JPG/PNG max 5MB</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Deskripsi Kegiatan</label>
                            {{-- ✅ rich editor --}}
                            <textarea name="deskripsi"
                                      class="form-control rich-desc"
                                      required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Tagar Kegiatan</label>
                            <input type="text" name="tagar" class="form-control"
                                   placeholder="contoh: edukasi, kunjungan, pelatihan">
                            <small class="text-muted">Pisahkan dengan koma</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success w-100"
                            style="border-radius:12px;font-weight:800;">
                        <i class="bi bi-plus-circle me-1"></i> Simpan Artikel
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- ✅ CKEditor 5 CDN (NO API KEY, NO CLOUD SERVICE) --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    function initEditors(){
        document.querySelectorAll('textarea.rich-desc').forEach((el) => {
            if (el.dataset.ckeInitialized) return;

            ClassicEditor.create(el, {
                toolbar: {
                    items: [
                        'undo','redo','|',
                        'heading','|',
                        'bold','italic','underline','|',
                        'subscript','superscript','|',
                        'bulletedList','numberedList','|',
                        'alignment','outdent','indent','|',
                        'insertTable','link','blockQuote','|',
                        'removeFormat','codeBlock'
                    ],
                    shouldNotGroupWhenFull: true
                },
                table: {
                    contentToolbar: ['tableColumn','tableRow','mergeTableCells']
                },
                language: 'id'
            }).then(editor => {
                el.dataset.ckeInitialized = "1";

                // simpan instance editor supaya bisa diakses saat submit
                el._editor = editor;

                // ✅ sync terus menerus isi editor -> textarea
                editor.model.document.on('change:data', () => {
                    el.value = editor.getData();
                });

                // ✅ paksa tinggi editor biar footer modal tetap terlihat
                const editable = editor.ui.view.editable.element;
                editable.style.minHeight = "200px";
                editable.style.maxHeight = "320px";
                editable.style.overflowY = "auto";
            }).catch(err => console.error(err));
        });
    }

    initEditors();

    // ✅ kalau modal dibuka setelah load, tetap aman
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('shown.bs.modal', initEditors);
    });

    // ✅ sebelum submit: pastikan semua textarea terisi dari editor
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            form.querySelectorAll('textarea.rich-desc').forEach(t => {
                if (t._editor) {
                    t.value = t._editor.getData();
                }
            });
        });
    });

});
</script>

@endsection
