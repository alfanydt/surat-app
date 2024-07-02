@extends('layouts.admin')

@section('title')
    Surat Permohonan Upah Lembur
@endsection

@section('container')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Surat Permohonan Upah Lembur</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Surat Permohonan Upah Lembur</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Surat Permohonan Upah Lembur
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Tanggal Surat</th>
                            <th>Penerima</th>
                            <th>Nama Pengirim</th>
                            <th>Jabatan Pengirim</th>
                            <th>Detail Permohonan</th>
                            <th>Rincian Karyawan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($letters as $letter)
                            <tr>
                                <td>{{ $letter->letter_date }}</td>
                                <td>{{ $letter->recipient }}</td>
                                <td>{{ $letter->sender_name }}</td>
                                <td>{{ $letter->sender_position }}</td>
                                <td>{{ $letter->details }}</td>
                                <td>
                                    @foreach ($letter->employees as $employee)
                                        <p>Nama: {{ $employee['name'] }}, Jumlah Hari: {{ $employee['days'] }}</p>
                                    @endforeach
                                </td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="{{ route('detail-surat', $letter->id) }}">
                                        <i class="fa fa-search-plus"></i> &nbsp; Detail
                                    </a>
                                    <a class="btn btn-primary btn-xs" href="{{ route('letter.edit', $letter->id) }}">
                                        <i class="fas fa-edit"></i> &nbsp; Ubah
                                    </a>
                                    <form action="{{ route('letter.destroy', $letter->id) }}" method="POST" onsubmit="return confirm('Anda akan menghapus item ini dari situs anda?')">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-xs">
                                            <i class="far fa-trash-alt"></i> &nbsp; Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
