@extends('template.app')
@section('hanger', 'active')
@section('content')
  <!-- Modal -->
  {{-- add data --}}
  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('operator.loading.hanger.tambah') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" value="{{ Auth::user()->nama }}" required readonly>
                <input type="text" name="user_id" class="form-control" value="{{ Auth::user()->id }}" required readonly hidden>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Type</label>
                <input type="text" name="type" class="form-control" value="{{ old('type') }}" required placeholder="Type"></input>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">QTY</label>
                <input type="number" name="qty" class="form-control" value="{{ old('qty') }}" required placeholder="Qty"></input>
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
  {{-- Print --}}
  <div class="modal fade" id="print" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Filter Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST">
        @csrf
        <div class="modal-body">
            <div class="row">
                <div class="col-3 col-md-4">
                    <input class="form-control" type="date" value="{{ $date }}">
                </div>
                <div class="col-3 col-md-2">
                    <center><label for="exampleFormControlInput1" class="form-label mt-2">S/d</label></center>
                </div>
                <div class="col-3 col-md-4">
                    <input class="form-control" name="akhir" type="date" value="{{ old('akhir') }}">
                </div>
                <div class="col-3 col-md-2">
                    <button class="btn btn-primary bx bx-filter-alt"></button>
                </div>
            </div>
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
                <h5 class="card-title">Halaman Hangger</h5>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class='bx bx-plus'></i></button>
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
                        <th>Operator Loading</th>
                        <th>Type</th>
                        <th>QTY</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($data as $data)
                {{-- edit modal --}}
                <div class="modal fade" id="ModalEdit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('operator.loading.hanger.edit', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" value="{{ $data->user->nama }}" required readonly>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Type</label>
                                <input type="text" name="type" class="form-control" value="{{ $data->type }}" required placeholder="Type"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">QTY In</label>
                                <input type="number" name="qty" class="form-control" value="{{ $data->qty }}" required placeholder="Qty"></input>
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
                    <td>{{ $data->user->nama }}</td>
                    <td>{{ $data->type }}</td>
                    <td>{{ $data->qty }}</td>
                    <td class="d-flex flex-column flex-sm-row">
                        <button data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $data->id }}" class="btn btn-warning btn-sm mb-2 mb-sm-0 me-sm-2 bx bx-edit"></button>
                        <a href="{{ route('operator.loading.hanger.hapus',['id' => $data->id]) }}" class="btn btn-danger btn-sm bx bx-trash" data-confirm-delete="true"></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
