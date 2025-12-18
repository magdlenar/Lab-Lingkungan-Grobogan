@extends('layouts.app')
@section('title', $galeri->judul)

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

    // Optional related list (kalau controller ngirim)
    $relatedGaleri = $relatedGaleri ?? collect();

    // fallback kalau belum ada related dari controller:
    if($relatedGaleri->isEmpty()){
        try {
            $relatedGaleri = \App\Models\Galeri::where('id','!=',$galeri->id)
                                ->latest()
                                ->take(4)
                                ->get();
        } catch (\Throwable $e) {
            $relatedGaleri = collect();
        }
    } else {
        $relatedGaleri = $relatedGaleri->sortByDesc('created_at')->take(4);
    }

    // ✅ helper URL gambar Backblaze (private/public sama-sama aman)
    $b2Img = function ($path) {
        if (empty($path)) return null;

        // kalau sudah full URL, pakai langsung
        if (Str::startsWith($path, ['http://','https://'])) return $path;

        // bersihin kalau ada prefix "storage/"
        $key = ltrim($path, '/');
        $key = Str::replaceFirst('storage/', '', $key);

        try {
            // bucket private -> signed url
            return Storage::disk('s3')->temporaryUrl($key, now()->addMinutes(30));
        } catch (\Throwable $e) {
            return null;
        }
    };

    $heroImg = $b2Img($galeri->gambar ?? null);
@endphp

<style>
    :root{
        --g-green:#189e1e;
        --g-soft:#f0fdf4;
        --g-border:#eef1f5;
        --g-text:#0f172a;
        --g-muted:#64748b;
        --g-card:#ffffff;
    }

    .wrap{ padding:26px 0; }

    /* ===== Layout utama ===== */
    .article-layout{
        display:grid;
        grid-template-columns: 1.2fr .8fr;
        gap:18px;
        align-items:start;
    }

    .card-soft{
        background:var(--g-card);
        border-radius:18px;
        padding:18px;
        box-shadow:0 8px 25px rgba(0,0,0,.06);
        border:1px solid var(--g-border);
    }

    /* ===== Header artikel ===== */
    .article-title{
        font-weight:900;
        color:var(--g-text);
        font-size:26px;
        line-height:1.25;
        margin-bottom:6px;
    }
    .article-meta{
        display:flex; flex-wrap:wrap; gap:10px; align-items:center;
        font-size:13px; color:var(--g-muted);
        margin-bottom:10px;
    }
    .meta-dot{
        width:4px;height:4px;border-radius:999px;background:#cbd5e1;display:inline-block;
    }

    .tag{
        display:inline-flex; align-items:center; gap:6px;
        background:var(--g-soft); color:#166534;
        border:1px solid #bbf7d0; border-radius:999px;
        padding:4px 9px; font-size:12px; font-weight:800; margin:2px 2px;
        white-space:nowrap;
    }

    /* ===== Hero image responsive orientation ===== */
    .hero-frame{
        background:#0b1220;
        border-radius:16px;
        overflow:hidden;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:6px;
        border:1px solid var(--g-border);
        box-shadow:0 10px 28px rgba(0,0,0,.10);
    }
    .hero-img{
        width:100%;
        height:auto;
        max-height:520px;      /* ga kegedean */
        object-fit:contain;    /* ga kepotong; portrait tetap portrait */
        border-radius:12px;
        background:#0b1220;
    }

    /* ===== Isi artikel ===== */
    .article-body{
        font-size:15.5px;
        line-height:1.8;
        color:#0f172a;
    }
    .article-body p{ margin-bottom:12px; }
    .article-body img{
        max-width:100%;
        height:auto;
        border-radius:12px;
        margin:10px 0;
    }

    /* ===== Related ===== */
    .related-head{
        display:flex; align-items:center; justify-content:space-between;
        margin-bottom:12px;
    }
    .related-head h5{
        font-weight:900; margin:0; color:var(--g-text);
        font-size:18px;
    }
    .related-item{
        display:flex; gap:10px;
        padding:10px;
        border-radius:14px;
        border:1px solid var(--g-border);
        background:#fff;
        transition:.2s;
    }
    .related-item:hover{
        transform:translateY(-2px);
        box-shadow:0 8px 20px rgba(0,0,0,.06);
    }
    .related-thumb{
        width:118px; min-width:118px; height:82px;
        border-radius:10px; object-fit:cover; background:#f1f5f9;
    }
    .related-body{
        display:flex; flex-direction:column; gap:4px; justify-content:center;
        min-width:0;
    }
    .related-title{
        font-weight:800; font-size:14px; color:var(--g-text);
        line-height:1.3;

        /* ✅ webkit + standar supaya warning hilang */
        display:-webkit-box;
        -webkit-box-orient:vertical;
        -webkit-line-clamp:2;

        display:box;              /* fallback lama */
        box-orient:vertical;      /* fallback lama */
        line-clamp:2;             /* properti standar */

        overflow:hidden;
    }
    .related-meta{ font-size:12px; color:var(--g-muted); }

    /* ===== Comments ===== */
    .comment-form{
        display:grid;
        grid-template-columns: 1fr 2fr auto;
        gap:8px;
        margin-bottom:14px;
    }
    .comment-form input{
        height:40px;
        border-radius:12px;
        font-size:14px;
    }
    .comment-form button{
        height:40px;
        border-radius:12px;
        font-weight:800;
        padding:0 14px;
        background:var(--g-green);
        border:none; color:#fff;
        white-space:nowrap;
    }

    .comment-item{
        display:flex; gap:10px; padding:12px 0;
        border-bottom:1px dashed #e5e7eb;
    }
    .comment-avatar{
        width:38px;height:38px;border-radius:50%;
        background:#eef4ff;color:#0d6efd;
        display:flex;align-items:center;justify-content:center;
        font-weight:900;font-size:14px; flex-shrink:0;
    }
    .comment-content{ flex:1; min-width:0; }
    .comment-name{
        font-weight:800; color:#0f172a; font-size:14px;
        display:flex; align-items:center; gap:6px;
    }
    .comment-time{ font-size:12px; color:var(--g-muted); }
    .comment-text{ font-size:14px; color:#1f2937; margin-top:4px; }

    /* ===== Pagination modern (samakan galeri) ===== */
    .pagination-modern-wrap nav{ display:flex; justify-content:center; }
    .pagination-modern-wrap .pagination{
        gap:6px; padding:6px 10px; background:#fff; border-radius:999px;
        box-shadow:0 6px 18px rgba(0,0,0,.06); border:1px solid #eef1f5;
    }
    .pagination-modern-wrap .page-link{
        width:32px;height:32px; display:flex;align-items:center;justify-content:center;
        font-size:13px; background:#f1f5f9; border:none; color:#475569; font-weight:700;
        border-radius:10px !important; transition:.18s;
    }
    .pagination-modern-wrap .page-link:hover{ background:#e2e8f0; transform:translateY(-1px); }
    .pagination-modern-wrap .page-item.active .page-link{
        background:#189e1e !important; color:#fff !important;
        box-shadow:0 4px 10px rgba(24,158,30,.25);
    }
    .pagination-modern-wrap .page-item:first-child .page-link,
    .pagination-modern-wrap .page-item:last-child .page-link{
        width:auto;height:32px; padding:0 12px; border-radius:999px !important; font-weight:800;
    }
    .pagination-modern-wrap .page-item.disabled .page-link{ opacity:.5; background:#f8fafc; }

    /* ===== Responsive ===== */
    @media(max-width:992px){
        .article-layout{ grid-template-columns:1fr; }
        .related-thumb{ width:130px; min-width:130px; height:90px; }
    }
    @media(max-width:576px){
        .wrap{ padding:18px 0; }
        .article-title{ font-size:21px; }
        .hero-img{ max-height:420px; }
        .comment-form{
            grid-template-columns:1fr;
        }
        .comment-form button{ width:100%; }
        .related-item{ gap:8px; }
        .related-thumb{ width:110px; min-width:110px; height:80px; }
        .pagination-modern-wrap .pagination{
            flex-wrap:wrap; border-radius:16px; padding:8px; gap:5px;
        }
        .pagination-modern-wrap .page-link{
            width:30px;height:30px;font-size:12.5px;border-radius:9px !important;
        }
        .pagination-modern-wrap .page-item:first-child .page-link,
        .pagination-modern-wrap .page-item:last-child .page-link{
            height:30px; padding:0 10px; font-size:12.5px;
        }
    }
</style>

<div class="container wrap">
    <div class="article-layout">

        {{-- ================= LEFT: MAIN ARTICLE ================= --}}
        <div class="d-flex flex-column gap-3">

            {{-- Header --}}
            <div class="card-soft">
                <h3 class="article-title">{{ $galeri->judul }}</h3>

                <div class="article-meta">
                    <span><i class="bi bi-calendar-event me-1"></i>{{ $galeri->created_at->translatedFormat('d F Y') }}</span>
                    <span class="meta-dot"></span>
                    <span><i class="bi bi-eye me-1"></i>Artikel Galeri</span>
                </div>

                <div class="d-flex flex-wrap">
                    @foreach($galeri->tag_array as $t)
                        <span class="tag">#{{ $t }}</span>
                    @endforeach
                </div>
            </div>

            {{-- Hero Image --}}
            @if($heroImg)
                <div class="hero-frame">
                    <img src="{{ $heroImg }}" class="hero-img" alt="hero">
                </div>
            @endif

            {{-- Body --}}
            <div class="card-soft">
                <div class="article-body">
                    {!! $galeri->deskripsi !!}
                </div>
            </div>

            {{-- Comments --}}
            <div class="card-soft">
                <h5 class="fw-bold mb-3">Komentar Pembaca</h5>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST" action="{{ route('galeri.comment.store', $galeri->id) }}" class="comment-form">
                    @csrf
                    <input type="text" name="nama" class="form-control" placeholder="Nama kamu..." required>
                    <input type="text" name="komentar" class="form-control" placeholder="Tulis komentar..." required>
                    <button type="submit"><i class="bi bi-send me-1"></i>Kirim</button>
                </form>

                @forelse($comments as $c)
                    @php $initial = strtoupper(mb_substr($c->nama ?? 'A',0,1)); @endphp
                    <div class="comment-item">
                        <div class="comment-avatar">{{ $initial }}</div>
                        <div class="comment-content">
                            <div class="comment-name">
                                {{ $c->nama }}
                                <span class="comment-time">• {{ $c->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="comment-text">{{ $c->komentar }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-muted">Belum ada komentar.</div>
                @endforelse

                @if($comments->hasPages())
                    <div class="mt-3 pagination-modern-wrap">
                        {{ $comments->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>

            <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary btn-sm align-self-start">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        {{-- ================= RIGHT: RELATED ================= --}}
        <aside class="d-flex flex-column gap-3">
            <div class="card-soft">
                <div class="related-head">
                    <h5>Related News</h5>
                    <a href="{{ route('galeri.index') }}" class="small text-muted text-decoration-none">See all</a>
                </div>

                <div class="d-flex flex-column gap-2">
                    @forelse($relatedGaleri as $r)
                        @php $relImg = $b2Img($r->gambar ?? null); @endphp
                        <a href="{{ route('galeri.show',$r->slug) }}" class="text-decoration-none text-dark">
                            <div class="related-item">
                                @if($relImg)
                                    <img src="{{ $relImg }}" class="related-thumb" alt="related">
                                @else
                                    <div class="related-thumb d-flex align-items-center justify-content-center text-muted">
                                        No Image
                                    </div>
                                @endif
                                <div class="related-body">
                                    <div class="related-title">{{ $r->judul }}</div>
                                    <div class="related-meta">{{ $r->created_at->translatedFormat('d F Y') }}</div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-muted small">Belum ada artikel terkait.</div>
                    @endforelse
                </div>
            </div>
        </aside>

    </div>
</div>
@endsection
