@extends('template.app')
@section('loading', 'active')
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
        <form action="{{ route('operator.loading.tambah') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" value="{{ Auth::user()->nama }}" required readonly>
                <input type="text" name="user_id" class="form-control" value="{{ Auth::user()->id }}" required readonly hidden>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Planing</label>
                <select name="planing_id" class="form-control">
                    <option selected disabled>== Pilih Salah Satu ==</option>
                    @foreach ($planing as $planing)
                        <option value="{{ $planing->id }}">Tanggal: {{ $planing->tanggal }}, Penanggung jawab: {{ $planing->user->nama }}, Part Number: {{ $planing->part_no}}, Part Name: {{ $planing->part_name}}, QTY: {{ $planing->qty}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Hanger</label>
                <select name="hangger_id" class="form-control">
                    <option selected disabled>== Pilih Salah Satu ==</option>
                    @foreach ($hanger as $hanggeritem)
                        <option value="{{ $hanggeritem->id }}">Penanggung Jawab: {{ $hanggeritem->user->nama }}, Type: {{ $hanggeritem->type }}, QTY: {{ $hanggeritem->qty }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Lot No</label>
                <input type="text" name="lot_no" class="form-control" value="{{ old('lot_no') }}" required placeholder="Lot No"></input>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">QTY Input</label>
                <input type="number" name="qty_in" class="form-control" value="{{ old('qty_in') }}" required placeholder="QTY Input"></input>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Time Input</label>
                <input type="time" name="time_in" class="form-control" value="{{ old('time_in') }}" required placeholder="Time Input"></input>
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
                <h5 class="card-title">Halaman Loading</h5>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" style="margin-right: 5px" data-bs-toggle="modal" data-bs-target="#add"><i class='bx bx-plus'></i></button>
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
                        <th>Tanggal</th>
                        <th>Part No</th>
                        <th>Part Name</th>
                        <th>Lot No</th>
                        <th>Hanger (Type/Qty)</th>
                        <th>Qty In</th>
                        <th>Time Input</th>
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
                        <form action="{{ route('operator.loading.edit', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" value="{{ $data->user->nama }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" value="{{ $data->planing->tanggal }}" required readonly></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Part No</label>
                                <input type="text" class="form-control" value="{{ $data->planing->part_no }}" required readonly placeholder="Part No"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Part Name</label>
                                <input type="text" class="form-control" value="{{ $data->planing->part_name }}" required readonly placeholder="Part Name"></input>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Lot No</label>
                                <input type="text" name="lot_no" class="form-control" value="{{ $data->lot_no }}" required placeholder="Lot No"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Hangger</label>
                                <select name="hangger_id" class="form-control" required>
                                    <option selected disabled>== Pilih Salah Satu ==</option>
                                    @foreach ($hanger as $hangerData)
                                        <option value="{{ $hangerData->id }}">Penanggung Jawab: {{ $hangerData->user->nama }}, Type: {{ $hangerData->type }}, QTY: {{ $hangerData->qty }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">QTY In</label>
                                <input type="number" name="qty_in" class="form-control" value="{{ $data->qty_in }}" required placeholder="Qty In"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Time Input</label>
                                <input type="time" name="time_in" class="form-control" value="{{ $data->time_in }}" required placeholder="Qty In"></input>
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
                    <td>{{ $data->planing->tanggal }}</td>
                    <td>{{ $data->planing->part_no }}</td>
                    <td>{{ $data->planing->part_name }}</td>
                    <td>{{ $data->lot_no }}</td>
                    <td>{{ $data->hanger->type }} / {{ $data->hanger->qty }}</td>
                    <td>{{ $data->qty_in }}</td>
                    <td>{{ $data->time_in }}</td>
                    <td class="d-flex flex-column flex-sm-row">
                        <button data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $data->id }}" class="btn btn-warning btn-sm mb-2 mb-sm-0 me-sm-2 bx bx-edit"></button>
                        <a href="{{ route('hapus.loading',['id' => $data->id]) }}" class="btn btn-danger btn-sm bx bx-trash" data-confirm-delete="true"></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
