@extends('Layout.sidebar')
@section('content1')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">List Buku</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> <button type="button" class="btn btn-primary"
                        data-toggle="modal" data-target="#exampleModal">Tambah Buku</button>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </h5>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>cover</th>
                                <th>Judul</th>
                                <th>Sinopsis</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>

                            <tr>
                                <th>cover</th>
                                <th>Judul</th>
                                <th>Sinopsis</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($book as $books)
                                <tr>
                                    <th style="text-align:center;"> <img style=" height: 200px;"
                                        src="{{ asset('assets/img/' . $books->image) }}" alt=""></th>
                                    <th>{{ $books->judul }}</th>
                                    <th>{{ $books->synopsis }}</th>
                                    <th>{{ $books->category }}</th>
                                    <th>{{ $books->writer }}</th>
                                    <th>{{ $books->created_at }}</th>
                                    <th>
                                        <div class="d-flex">
                                            <form action="{{ route('delete.book', $books->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn " href=""> <i
                                                        class="fas fa-trash text-danger"></i></button>
                                            </form>
                                            <button class="btn " data-toggle="modal"
                                                data-target="#editModal{{ $books->id }}"><i
                                                    class="fas fa-pen-square text-primary"></i></button>
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


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Buku
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                </div>
                <div class="modal-body">
                    <form action="{{ route('book.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Judul</label>
                            <input type="text" name="judul" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Writer</label>
                            <input type="text" name="writer" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Kategori</label>
                            <select name="category" class="custom-select">
                                @foreach ($categories as $category)
                                    <option value="" hidden></option>
                                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label for="recipient-name" class="col-form-label">Image</label>
                        <div class="custom-file mb-3">
                            <input type="file" class="form-control" name="image" id="customFile">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Sinopsis</label>
                            <textarea class="form-control" name="synopsis" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    @foreach ($book as $books)
        <div class="modal fade" id="editModal{{ $books->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Buku
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('book.update', $books->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            @if ($errors->any())
                                <ul class="mt-3">
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Judul</label>
                                <input type="text" name="judul" value="{{ $books->judul }}" class="form-control"
                                    id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Writer</label>
                                <input type="text" value="{{ $books->writer }}" name="writer" class="form-control"
                                    id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Kategori</label>
                                <select name="category" class="custom-select">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="recipient-name" class="col-form-label">Image</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="form-control" name="image" id="customFile">
                            </div>
                            <label for="recipient-name" class="col-form-label">Image Sebelumnnya</label>
                            <img src="{{ asset('assets/img/' . $books->image) }}" alt="Preview Image"
                                id="previewImage{{ $books->id }}"
                                style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Sinopsis</label>
                                <textarea class="form-control" name="synopsis" id="exampleFormControlTextarea1" rows="3">{{ $books->synopsis }}</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>

                </div>
                <script>
                    function previewImage(input, previewId) {
                        var preview = document.getElementById(previewId);
                        var file = input.files[0];
                        var reader = new FileReader();

                        reader.onloadend = function() {
                            preview.src = reader.result;
                            preview.style.display = 'block';
                        }

                        if (file) {
                            reader.readAsDataURL(file);
                        } else {
                            preview.src = "";
                            preview.style.display = 'none';
                        }
                    }
                </script>
            </div>
        </div>
    @endforeach
@endsection
