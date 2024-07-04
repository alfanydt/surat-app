@extends('layouts.admin')

@section('title')
   Tambah Surat Permohonan Upah Lembur
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
                                Buat Surat Permohonan Upah Lembur
                            </h1> 
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-fluid px-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('letter.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row gx-4">
                    <div class="col-lg-9">
                        <div class="card mb-4">
                            <div class="card-header">Form Surat Permohonan Upah Lembur</div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="letter_date" class="col-sm-3 col-form-label">Tanggal Surat</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control @error('letter_date') is-invalid @enderror" value="{{ old('letter_date') }}" name="letter_date" required>
                                    </div>
                                    @error('letter_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="to" class="col-sm-3 col-form-label">Kepada Yth</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('to') is-invalid @enderror" value="{{ old('to') }}" name="to" placeholder="Direksi PT. BPR EKADHARMA BHINARAHARJA" required>
                                    </div>
                                    @error('to')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="sender_name" class="col-sm-3 col-form-label">Nama Pengirim</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('sender_name') is-invalid @enderror" value="{{ old('sender_name') }}" name="sender_name" placeholder="Tutut Sri Wahyu Murti SE" required>
                                    </div>
                                    @error('sender_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="sender_position" class="col-sm-3 col-form-label">Jabatan Pengirim</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('sender_position') is-invalid @enderror" value="{{ old('sender_position') }}" name="sender_position" placeholder="Kabag. Operasional" required>
                                    </div>
                                    @error('sender_position')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="letter_body" class="col-sm-3 col-form-label">Isi Surat</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control @error('letter_body') is-invalid @enderror" name="letter_body" rows="5" required>{{ old('letter_body') }}</textarea>
                                    </div>
                                    @error('letter_body')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="approval" class="col-sm-3 col-form-label">Disetujui Oleh</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('approval') is-invalid @enderror" value="{{ old('approval') }}" name="approval" placeholder="Rian Dian Raga S. Pd" required>
                                    </div>
                                    @error('approval')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="approval_position" class="col-sm-3 col-form-label">Jabatan Penyetuju</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('approval_position') is-invalid @enderror" value="{{ old('approval_position') }}" name="approval_position" placeholder="Kepala Cabang" required>
                                    </div>
                                    @error('approval_position')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="file" class="col-sm-3 col-form-label">Upload File (PDF)</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control @error('file') is-invalid @enderror" value="{{ old('file') }}" name="file" required>
                                        <div id="file" class="form-text">Ekstensi .pdf</div>
                                    </div>
                                    @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label for="file" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".selectx").select2({
            theme: "bootstrap-5"
        });
    </script>
@endpush
