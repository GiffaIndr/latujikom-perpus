@extends('Layout.sidebar')
@section('content1')
    <h1 class="h3 mb-2 text-gray-800">Users</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 style="font-weight: bold;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah
                    Users</button>
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
                            <th>Nama pengguna</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>NIS</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>

                        <tr>
                            <th>Name</th>
                            <th>Nama Panjang</th>
                            <th>Email</th>
                            <th>NIS</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($user as $users)
                            <tr>
                                <th>{{ $users->username }}</th>
                                <th>{{ $users->name }}</th>
                                <th>{{ $users->email }}</th>
                                <th>{{ $users->nis }}</th>
                                <th>{{ $users->role }}</th>
                                <th>
                                    <div class="d-flex">
                                        <form action="{{ route('delete.user', $users->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn " href=""> <i
                                                    class="fas fa-trash text-danger"></i></button>
                                        </form>
                                        <button class="btn " data-toggle="modal"
                                            data-target="#editModal{{ $users->id }}"><i
                                                class="fas fa-pen-square text-primary"></i></button>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Users
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
                        <form action="{{ route('user.create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Username</label>
                                <input type="text" name="username" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Longname</label>
                                <input type="text" name="name" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Password</label>
                                <input type="text" name="password" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Role</label>
                                <select name="role" class="custom-select">
                                    <option value="" hidden>Role</option>
                                    <option value="staff">Staff</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">NIS</label>
                                <input type="text" name="nis" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">address</label>
                                <textarea type="text" name="address" class="form-control" rows="3" id="recipient-name"></textarea>
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
    </div>

    @foreach ($user as $users)
        <div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('edit.user', $users->id) }}" method="POST"
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
                                <label for="recipient-name" class="col-form-label">Namaoengguna</label>
                                <input type="text" name="username" value="{{ $users->username }}"
                                    class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nama</label>
                                <input type="text" name="name" value="{{ $users->name }}" class="form-control"
                                    id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Password</label>
                                <input type="text" name="password" value=""
                                    class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="email" name="email" value="{{ $users->email }}" class="form-control"
                                    id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Role</label>
                                <select name="role" class="custom-select">
                                    <option value="{{ $users->role }}" hidden>{{ $users->role }}</option>
                                    <option value="staff">Staff</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">NIS</label>
                                <input type="text" value="{{ $users->nis }}" name="nis" class="form-control"
                                    id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">address</label>
                                <textarea type="text" name="address" placeholder="{{$users->address}}" class="form-control" rows="3" id="recipient-name"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
