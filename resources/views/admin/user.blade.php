@extends('template.app')
@section('user', 'active')

@section('content')
{{-- add data --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('user.admin.tambah') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama User</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Nama User" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">ID Card</label>
                    <input type="text" name="id_card" class="form-control" value="{{ old('id_card') }}" placeholder="ID Card" required></input>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Role</label>
                    <select class="form-select" name="role" aria-label="Default select example">
                        <option selected disabled>Pilih Salah Satu</option>
                        <option value="admin">Admin</option>
                        <option value="loading">Operator Loading</option>
                        <option value="packing">Operator Packing</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  {{-- end modal --}}
<div class="card w-100">
    <div class="card-body">
        <div id="adobe-dc-view"></div>
        <div class="row">
            <div class="col-6 col-md-8">
                <h5 class="card-title">Halaman Management User</h5>
                <p>Password Default: <b>katsuyama2024</b></p>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left: 2px"><i class='bx bx-plus' ></i></button>
                </div>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <div class="table-responsive mt-5">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>ID Card</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($data as $data)
                {{-- edit modal --}}
                <div class="modal fade" id="ModalEdit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Edit Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('user.admin.edit', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama User</label>
                                <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" placeholder="Nama User" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">ID Card</label>
                                <input type="text" name="id_card" class="form-control" value="{{ $data->id_card }}" placeholder="ID Card" required></input>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-select" aria-label="Default select example">
                                    <option value="" disabled {{ is_null($data->role) ? 'selected' : '' }}>Pilih Salah Satu</option>
                                    <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="loading" {{ $data->role == 'loading' ? 'selected' : '' }}>Operator Loading</option>
                                    <option value="packing" {{ $data->role == 'packing' ? 'selected' : '' }}>Operator Packing</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Ganti Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukan Password Baru | Default: katsuyama2024"></input>
                                <p style="color: red">*Lewati Proses ini jika tidak password tidak diganti.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                {{-- end modal --}}
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->id_card }}</td>
                    <td>{{ $data->role }}</td>
                    <td class="d-flex flex-column flex-sm-row">
                        <button data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $data->id }}" class="btn btn-warning btn-sm mb-2 mb-sm-0 me-sm-2 bx bx-edit"></button>
                        <a href="{{ route('user.admin.hapus',['id' => $data->id]) }}" class="btn btn-danger btn-sm bx bx-trash" data-confirm-delete="true"></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
