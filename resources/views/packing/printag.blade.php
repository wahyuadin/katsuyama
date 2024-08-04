@extends('template.app')
@section('printag', 'active')
@section('content')

{{-- @dd($data) --}}

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
                <h5 class="card-title">Halaman Data Print Tag</h5>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('packing.pdf') }}" class="btn btn-primary" style="margin-left:1.5px"><i class='bx bx-printer'></i></a>
                    {{-- <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#print" style="margin-left: 2px"><i class='bx bx-filter-alt' ></i></button> --}}
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
                        <th>Tanggal</th>
                        <th>Part No</th>
                        <th>Part Name</th>
                        <th>Proses</th>
                        <th>Next Proses</th>
                        <th>Lot No</th>
                        <th>QTY</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($data as $data)
                <div class="modal fade" id="ModalEdit{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('operator.packing.printag.edit', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->nama }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Planing</label>
                                <input type="text" class="form-control" value="{{$data->packing->loading->planing->tanggal }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Part No</label>
                                <input type="text" class="form-control" value="{{$data->packing->loading->planing->part_no }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Part Name</label>
                                <input type="text" class="form-control" value="{{$data->packing->loading->planing->part_name }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Lot No</label>
                                <input type="number" name="lot_no" class="form-control" value="{{ $data->packing->loading->lot_no }}" required placeholder="Lot No" readonly></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">QTY</label>
                                <input type="number" name="qty" class="form-control" value="{{ $data->packing->loading->planing->qty }}" required placeholder="Qty" readonly></input>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Proses</label>
                                <select name="proses" class="form-control">
                                    <option disabled selected>== Pilih Salah Satu ==</option>
                                    @php
                                        $user = \App\Models\User::all();
                                    @endphp
                                    @foreach ($user as $userItem)
                                        <option value="{{ $userItem->nama }}">{{ $userItem->nama }} - Operator {{ $userItem->role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Next Proses</label>
                                <select name="next_proses" class="form-control">
                                    <option disabled selected>== Pilih Salah Satu ==</option>
                                    @php
                                        $user = \App\Models\User::all();
                                    @endphp
                                    @foreach ($user as $userItem)
                                        <option value="{{ $userItem->nama }}">{{ $userItem->nama }} - Operator {{ $userItem->role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->packing->loading->planing->tanggal }}</td>
                    <td>{{ $data->packing->loading->planing->part_no }}</td>
                    <td>{{ $data->packing->loading->planing->part_name }}</td>
                    <td>{{ $data->proses ? $data->proses : '-'  }}</td>
                    <td>{{ $data->next_proses ? $data->next_proses : '-' }}</td>
                    <td>{{ $data->packing->loading->lot_no ? $data->packing->loading->lot_no : '-' }}</td>
                    <td>{{ $data->packing->loading->planing->qty ? $data->packing->loading->planing->qty : '-' }}</td>
                    <td class="d-flex flex-column flex-sm-row">
                        <button data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $data->id }}" class="btn btn-warning btn-sm mb-2 mb-sm-0 me-sm-2 bx bx-edit"></button>
                        {{-- <a href="{{ route('operator.packing.printag.hapus',['id' => $data->packing->loading->id]) }}" class="btn btn-danger btn-sm bx bx-trash" data-confirm-delete="true"></a> --}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
