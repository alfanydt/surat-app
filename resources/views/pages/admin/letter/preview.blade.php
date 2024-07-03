<!-- @extends('layouts.admin')

@section('title')
    Preview Surat Permohonan Upah Lembur
@endsection

@section('container')
    <main>
        <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
            <div class="container-fluid px-4">
                <div class="page-header-content">
                    <div class="row align-items-center justify-content-between pt-3">
                        <div class="col-auto mb-3">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Preview Surat Permohonan Upah Lembur
                            </h1> 
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container-fluid px-4">
            <div class="card mb-4">
                <div class="card-header">Preview Surat</div>
                <div class="card-body">
                    <p><strong>Tanggal Surat:</strong> {{ $letter->letter_date }}</p>
                    <p><strong>Kepada Yth:</strong> {{ $letter->to }}</p>
                    <p><strong>Nama Pengirim:</strong> {{ $letter->sender_name }}</p>
                    <p><strong>Jabatan Pengirim:</strong> {{ $letter->sender_position }}</p>
                    <p><strong>Isi Surat:</strong></p>
                    <p>{{ $letter->letter_body }}</p>
                    <p><strong>Disetujui Oleh:</strong> {{ $letter->approval }}</p>
                    <p><strong>Jabatan Penyetuju:</strong> {{ $letter->approval_position }}</p>
                    @if ($letter->file)
                        <p><strong>File:</strong> <a href="{{ Storage::url($letter->file) }}">Download</a></p>
                    @endif
                    <a href="{{ route('letter.edit', $letter->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('letter.download', $letter->id) }}" class="btn btn-primary">Cetak PDF</a>
                </div>
            </div>
        </div>
    </main>
@endsection -->
