@extends('layouts.Admin')

@section('content')

<div class="container py-4">

    <h4 class="fw-bold mb-3">Preview Surat Permohonan</h4>

    <div class="mb-3">
        <a href="{{ route('admin.file', $req->id) }}" class="btn btn-success">
            <i class="bi bi-download"></i> Download File
        </a>
    </div>

    <div class="card p-3">
        @php
            $ext = pathinfo($req->letter_file, PATHINFO_EXTENSION);
        @endphp

        @if (in_array($ext, ['pdf']))
            <embed src="{{ asset('storage/permohonan/'.$req->letter_file) }}"
                   type="application/pdf"
                   width="100%" height="600px" />
        @elseif (in_array($ext, ['jpg','jpeg','png']))
            <img src="{{ asset('storage/permohonan/'.$req->letter_file) }}"
                 class="img-fluid border rounded">
        @else
            <p class="text-muted">Preview tidak tersedia untuk file ini.</p>
        @endif
    </div>

</div>

@endsection
