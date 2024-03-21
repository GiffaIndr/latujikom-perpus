@extends('Layout.sidebar')
@section('content1')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Peminjaman</h1>
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
                                <th>Judul</th>
                                <th>Sinopsis</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tr>
                                <th>Judul</th>
                                <th>Sinopsis</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($book as $books)
                                <tr>
                                    <th>{{ $books->judul }}</th>
                                    <th>{{ $books->synopsis }}</th>
                                    <th>{{ $books->category }}</th>
                                    <th>{{ $books->writer }}</th>
                                    <th>{{ $books->status == 1 ? 'Sedang Dipinjam' : 'Ada' }}</th>
                                    <th>

                                        <div>
                                            @if ($books['status'] == 1)
                                                <form action="{{ route('update.pinjam', $books['id']) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger">Kembalikan buku</button>
                                                </form>
                                            @else
                                                <form action="{{ route('update.pinjam', $books['id']) }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-primary">Pinjam buku</button>
                                                </form>
                                            @endif
                                        </div>

                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
