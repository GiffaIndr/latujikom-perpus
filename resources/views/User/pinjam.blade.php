@extends('Layout.cdn')
@extends('Layout.navbar')
@section('content2')
    <div class="container-fluid container">
        <br>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Peminjaman</h1>
        <br>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 style="font-weight: bold;">
                    List buku yang dipinjam
                </h6>
            </div>
            @if ($errors->any())
            <ul class="mt-3">
                @foreach ($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Peminjam</th>
                                <th>Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($pinjams as $pinjam)
                                <tr>
                                    <th>{{ $pinjam->username }}</th>
                                    <th>{{ $pinjam->judul }}</th>
                                    <th>{{ $pinjam->tanggalPeminjam }}</th>
                                    <th>{{ $pinjam->tanggalPengembalian }}</th>
                                    
                                        @if($pinjam->statusPeminjaman == 'Belum dikembalikan')
                                        <td>
                                            Belum dikembalikan
                                        </td>
                                        <td>
                                            <form action="{{ route('pengembalian', $pinjam->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-primary">Kembalikan</button>
                                            </form>
                                        </td>
                                        @else
                                        <td>
                                            Sudah Dikembalikan
                                        </td>
                                        @endif
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection