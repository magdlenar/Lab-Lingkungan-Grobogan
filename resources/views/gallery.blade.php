@extends('layouts.app')
@section('title','Galeri')

@section('content')
@php
    $galeriCol = $galeris->getCollection();
    $isFirstPage = $galeris->currentPage() == 1;

    if($isFirstPage){
        $featured  = $galeriCol->first();
        $sideList  = $galeriCol->slice(1, 3);
        $gridList  = $galeriCol->slice(4);
    }else{
        $featured = null;
        $sideList = collect();
        $gridList = $galeriCol;
    }
@endphp

<style>
    :root{
        --g-green:#189e1e;
        --g-soft:#f0fdf4;
        --g-border:#eef1f5;
        --g-text:#0f172a;
        --g-muted:#64748b;
        --g-sky:#e9f6ff;
        --g-mint:#e8f7ec;
    }

    /* ===================== ANIMATED PAGE BG ===================== */
    .page-bg{
        position: relative;
        min-height: 100vh;
        padding-top: clamp(18px, 4vh, 50px);
        padding-bottom: clamp(24px, 4vh, 48px);
        overflow: hidden;

        /* animated gradient base */
        background: linear-gradient(120deg,
            #f6faf7 0%,
            #ffffff 35%,
            #f3f8ff 65%,
            #ffffff 100%
        );
        background-size: 250% 250%;
        animation: bgShift 16s ease-in-out infinite;
    }

    /* floating soft blobs */
    .page-bg::before,
    .page-bg::after{
        content:"";
        position:absolute;
        width:520px;
        height:520px;
        border-radius: 999px;
        filter: blur(75px);
        opacity:.55;
        z-index:0;
        animation: blobFloat 12s ease-in-out infinite;
        pointer-events:none;
    }
    .page-bg::before{
        background: radial-gradient(circle at 30% 30%, var(--g-mint), transparent 60%);
        top:-180px; left:-160px;
        animation-delay: 0s;
    }
    .page-bg::after{
        background: radial-gradient(circle at 30% 30%, var(--g-sky), transparent 60%);
        bottom:-200px; right:-170px;
        animation-delay: 3s;
    }

    /* extra bubbles layer */
    .bg-bubble{
        position:absolute;
        border-radius:999px;
        background: radial-gradient(circle at 30% 30%, rgba(24,158,30,.16), transparent 60%);
        filter: blur(30px);
        opacity:.45;
        z-index:0;
        animation: bubbleUp 10s ease-in-out infinite;
        pointer-events:none;
    }
    .b1{ width:180px;height:180px; left:6%; top:22%; animation-duration: 11s; }
    .b2{ width:220px;height:220px; right:8%; top:14%; animation-duration: 13s; animation-delay:2s; }
    .b3{ width:140px;height:140px; left:40%; bottom:6%; animation-duration: 9s; animation-delay:1s; }
    .b4{ width:170px;height:170px; right:35%; bottom:18%; animation-duration: 12s; animation-delay:3.5s; }

    @keyframes bgShift{
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    @keyframes blobFloat{
        0%,100%{ transform: translate(0,0) scale(1); }
        50%{ transform: translate(20px, 25px) scale(1.05); }
    }
    @keyframes bubbleUp{
        0%,100%{ transform: translateY(0) scale(1); opacity:.40; }
        50%{ transform: translateY(-26px) scale(1.08); opacity:.55; }
    }

    /* ensure content on top */
    .section-wrap{
        position: relative;
        z-index: 2;
        padding:26px 0;
    }

    /* ====== SECTION TITLE ====== */
    .section-title{ text-align:center; margin-bottom:14px; }
    .section-title h3{
        font-weight:800;
        color:var(--g-green);
        font-size:28px; margin-bottom:6px;
        line-height:1.2;
    }
    .section-title p{ color:var(--g-muted); margin:0; }

    /* ====== SEARCH ====== */
    .search-wrap{ display:flex; justify-content:center; margin:18px 0 24px; }
    .search-box{
        width:100%; max-width:560px; background:#fff; border:1px solid var(--g-border);
        border-radius:14px; padding:6px 8px; display:flex; gap:8px; align-items:center;
        box-shadow:0 6px 18px rgba(0,0,0,.05);
    }
    .search-box input{
        border:none; outline:none; width:100%; font-size:14px; background:transparent;
    }
    .search-box button{
        border-radius:10px; font-weight:700; padding:7px 12px;
        background:var(--g-green); color:#fff; border:none; white-space:nowrap;
        font-size:14px;
    }

    /* ====== LINE CLAMP UTIL ====== */
    .clamp-2, .clamp-3{
        display:-webkit-box;
        -webkit-box-orient:vertical;
        overflow:hidden;
        line-clamp: unset;
    }
    .clamp-2{ -webkit-line-clamp:2; line-clamp:2; }
    .clamp-3{ -webkit-line-clamp:3; line-clamp:3; }

    /* ====== TOP BLOG AREA ====== */
    .top-blog{
        display:grid;
        grid-template-columns: 1.35fr .65fr;
        gap:16px;
        margin-bottom:26px;
    }

    .featured-card{
        position:relative; border-radius:18px; overflow:hidden; height:100%;
        background:#0b1220; box-shadow:0 10px 28px rgba(0,0,0,.10);
        border:1px solid var(--g-border);
        min-height:320px;
        transition:.25s;
    }
    .featured-card:hover{ transform: translateY(-2px); }
    .featured-thumb{
        width:100%; height:100%; object-fit:cover; display:block; filter:brightness(.7);
    }
    .featured-overlay{
        position:absolute; inset:0; display:flex; flex-direction:column; justify-content:flex-end;
        padding:18px 18px 16px; color:#fff;
        background:linear-gradient(to top, rgba(0,0,0,.65), rgba(0,0,0,0) 55%);
    }
    .featured-title{
        font-size:20px; font-weight:800; margin-bottom:6px; line-height:1.25;
    }
    .featured-meta{ font-size:12.5px; opacity:.9; margin-bottom:8px; }
    .featured-desc{
        font-size:13.5px; opacity:.95; max-width:90%;
    }

    .side-list{ display:flex; flex-direction:column; gap:12px; }
    .side-card{
        display:flex; gap:10px; background:#fff; border:1px solid var(--g-border);
        border-radius:14px; overflow:hidden; box-shadow:0 6px 18px rgba(0,0,0,.05);
        transition:.2s;
    }
    .side-card:hover{ transform:translateY(-2px); }
    .side-thumb{
        width:120px; min-width:120px; height:96px; object-fit:cover; background:#f3f4f6;
    }
    .side-body{
        padding:10px 10px 8px; display:flex; flex-direction:column; justify-content:center;
    }
    .side-title{
        font-weight:800; font-size:14px; color:var(--g-text); margin-bottom:4px;
        line-height:1.25;
    }
    .side-meta{ font-size:12px; color:var(--g-muted); }
    .side-more{
        font-size:12.5px; font-weight:800; color:var(--g-green); margin-top:6px;
        display:inline-flex; align-items:center; gap:6px;
    }

    /* ====== GRID AREA ====== */
    .grid-head{
        display:flex; justify-content:space-between; align-items:flex-end; gap:10px; flex-wrap:wrap;
        margin:10px 0 14px;
    }
    .grid-head h4{ font-weight:800; color:var(--g-text); margin:0; font-size:20px; }
    .grid-head p{ margin:0; color:var(--g-muted); font-size:13.5px; }

    .gallery-card{
        background:#fff;border-radius:18px;overflow:hidden;
        box-shadow:0 8px 25px rgba(0,0,0,.06);
        border:1px solid var(--g-border); height:100%;
        transition:.2s;
    }
    .gallery-card:hover{ transform: translateY(-2px); }
    .gallery-thumb{
        width:100%;height:190px;object-fit:cover;background:#f3f4f6;
    }

    .gallery-title{
        font-weight:800; font-size:15.5px; color:var(--g-text); margin-bottom:4px;
        line-height:1.3;
    }
    .gallery-desc{
        font-size:13.5px; color:#334155;
    }

    .tag{
        display:inline-block;background:var(--g-soft);color:#166534;
        border:1px solid #bbf7d0;border-radius:999px;
        padding:2px 8px;font-size:11.5px;font-weight:800;margin:2px 2px;
        white-space:nowrap;
    }

    /* ===================== PAGINATION ===================== */
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

    /* ====== RESPONSIVE ====== */
    @media(max-width:992px){
        .top-blog{ grid-template-columns:1fr; }
        .featured-card{ min-height:260px; }
    }

    @media(max-width:576px){
        .section-wrap{ padding:18px 0; }

        .section-title h3{ font-size:22px; }
        .section-title p{ font-size:13px; }

        .search-box{ border-radius:12px; padding:6px; }
        .search-box input{ font-size:13.5px; }
        .search-box button{ font-size:13px; padding:6px 10px; }

        .top-blog{ gap:12px; }

        .featured-card{
            min-height:220px;
            border-radius:14px;
        }
        .featured-overlay{ padding:12px; }
        .featured-title{ font-size:17px; }
        .featured-meta{ font-size:11.5px; margin-bottom:6px; }
        .featured-desc{ font-size:12.5px; max-width:100%; }

        .side-list{
            flex-direction:row;
            overflow-x:auto;
            gap:10px;
            padding-bottom:4px;
            scroll-snap-type:x mandatory;
        }
        .side-card{
            min-width:78%;
            scroll-snap-align:start;
            flex-direction:row;
            border-radius:12px;
        }
        .side-thumb{
            width:100px; min-width:100px; height:80px;
        }
        .side-body{ padding:8px; }
        .side-title{ font-size:13.5px; }
        .side-meta{ font-size:11.5px; }
        .side-more{ font-size:12px; }

        .gallery-card{ border-radius:14px; }
        .gallery-thumb{ height:170px; }
        .gallery-title{ font-size:14.5px; }
        .gallery-desc{ font-size:12.8px; }

        .pagination-modern-wrap .pagination{
            flex-wrap:wrap;
            border-radius:16px;
            padding:8px;
            gap:5px;
        }
        .pagination-modern-wrap .page-link{
            width:30px;height:30px;font-size:12.5px;border-radius:9px !important;
        }
        .pagination-modern-wrap .page-item:first-child .page-link,
        .pagination-modern-wrap .page-item:last-child .page-link{
            height:30px; padding:0 10px; font-size:12.5px;
        }

        /* bubbles lebih kecil di HP */
        .page-bg::before,.page-bg::after{ width:360px;height:360px;filter:blur(60px); }
        .b1,.b2,.b3,.b4{ opacity:.35; }
    }
</style>

<div class="page-bg">
    {{-- soft bubbles --}}
    <span class="bg-bubble b1"></span>
    <span class="bg-bubble b2"></span>
    <span class="bg-bubble b3"></span>
    <span class="bg-bubble b4"></span>

    <div class="container section-wrap">

        {{-- TITLE --}}
        <div class="section-title">
            <h3>Galeri Kegiatan</h3>
            <p>Publikasi kegiatan Laboratorium Lingkungan</p>
        </div>

        {{-- SEARCH --}}
        <form method="GET" class="search-wrap">
            <div class="search-box">
                <i class="bi bi-search text-muted"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul / tagar...">
                <button type="submit"><i class="bi bi-search me-1"></i> Cari</button>
            </div>
        </form>

        {{-- TOP BLOG hanya halaman 1 --}}
        @if($isFirstPage && $featured)
            <div class="top-blog">

                {{-- FEATURED --}}
                <a href="{{ route('galeri.show', $featured->slug) }}" class="text-decoration-none">
                    <div class="featured-card">
                        @if($featured->gambar)
                            <img src="{{ asset('storage/'.$featured->gambar) }}" class="featured-thumb" alt="featured">
                        @else
                            <div class="featured-thumb d-flex align-items-center justify-content-center text-white">
                                Tidak ada gambar
                            </div>
                        @endif

                        <div class="featured-overlay">
                            <div class="featured-title clamp-2">{{ $featured->judul }}</div>
                            <div class="featured-meta">
                                <i class="bi bi-calendar-event me-1"></i>
                                {{ $featured->created_at->translatedFormat('d F Y') }}
                            </div>
                            <div class="featured-desc clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($featured->deskripsi), 140) }}
                            </div>
                        </div>
                    </div>
                </a>

                {{-- SIDE LIST --}}
                <div class="side-list">
                    @foreach($sideList as $s)
                        <a href="{{ route('galeri.show', $s->slug) }}" class="text-decoration-none text-dark">
                            <div class="side-card">
                                @if($s->gambar)
                                    <img src="{{ asset('storage/'.$s->gambar) }}" class="side-thumb" alt="side">
                                @else
                                    <div class="side-thumb d-flex align-items-center justify-content-center text-muted">
                                        Tidak ada gambar
                                    </div>
                                @endif

                                <div class="side-body">
                                    <div class="side-title clamp-2">{{ $s->judul }}</div>
                                    <div class="side-meta">
                                        {{ $s->created_at->translatedFormat('d F Y') }}
                                    </div>
                                    <div class="side-more">
                                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        @endif

        {{-- GRID HEAD --}}
        <div class="grid-head">
            <div>
                <h4>{{ $isFirstPage ? 'Artikel Lainnya' : 'Semua Artikel' }}</h4>
                <p>Jelajahi kegiatan terbaru yang sudah dipublikasikan</p>
            </div>
        </div>

        {{-- GRID --}}
        <div class="row g-3">
            @forelse($gridList as $g)
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('galeri.show', $g->slug) }}" class="text-decoration-none text-dark">
                        <div class="gallery-card">
                            @if($g->gambar)
                                <img src="{{ asset('storage/'.$g->gambar) }}" class="gallery-thumb" alt="thumb">
                            @else
                                <div class="gallery-thumb d-flex align-items-center justify-content-center text-muted">
                                    Tidak ada gambar
                                </div>
                            @endif

                            <div class="p-3">
                                <div class="gallery-title clamp-2">{{ $g->judul }}</div>
                                <div class="text-muted small mb-2">
                                    {{ $g->created_at->translatedFormat('d F Y') }}
                                </div>

                                <div class="gallery-desc clamp-3 mb-2">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($g->deskripsi), 95) }}
                                </div>

                                <div>
                                    @foreach($g->tag_array as $t)
                                        <span class="tag">#{{ $t }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center text-muted py-5">
                        Belum ada artikel galeri.
                    </div>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        @if($galeris->hasPages())
            <div class="mt-3 pagination-modern-wrap">
                {{ $galeris->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>
@endsection
