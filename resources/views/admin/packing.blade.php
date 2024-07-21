@extends('template.app')
@section('packing', 'active')
@section('content')
  <!-- Modal -->
  {{-- add data --}}
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('tambah.planing.admin') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" value="{{ Auth::user()->nama }}" required readonly>
                <input type="text" name="user_id" class="form-control" value="{{ Auth::user()->id }}" required readonly hidden>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $date }}" required></input>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Part No</label>
                <input type="text" name="part_no" class="form-control" value="{{ old('part_no') }}" required placeholder="Part No"></input>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Part Name</label>
                <input type="text" name="part_name" class="form-control" value="{{ old('part_name') }}" required placeholder="Part Name"></input>
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
                <h5 class="card-title">Halaman Packing</h5>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#print"><i class='bx bx-filter-alt' ></i></button>
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
                        <th>Operator Packing</th>
                        <th>Tanggal</th>
                        <th>Part No</th>
                        <th>Part Name</th>
                        <th>Lot No</th>
                        <th>Hanger (Type/Qty)</th>
                        <th>Qty-In</th>
                        <th>Qty-OK</th>
                        <th>Qty-NG</th>
                        <th>Remark</th>
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
                        <form action="{{ route('edit.packing.admin', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Operator Packing</label>
                                <input type="text" class="form-control" value="{{  $data->user->nama }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" value="{{  $data->loading->planing->tanggal }}" required readonly></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Part No</label>
                                <input type="text" class="form-control" value="{{ $data->loading->planing->part_no }}" required readonly placeholder="Part No"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Part Name</label>
                                <input type="text" class="form-control" value="{{ $data->loading->planing->part_name }}" required readonly placeholder="Part Name"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Lot No</label>
                                <input type="number" class="form-control" value="{{ $data->loading->lot_no }}" required placeholder="Lot No" readonly></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Hangger</label>
                                <input type="text" class="form-control" value="{{ $data->loading->hangger }}" required placeholder="Hangger" readonly></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">QTY In</label>
                                <input type="number" class="form-control" value="{{ $data->loading->qty_in }}" required placeholder="Qty In" readonly></input>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Qty Ok</label>
                                <input type="number" name="qty_ok" class="form-control" value="{{ $data->qty_ok }}" required placeholder="Qty In"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Qty NG</label>
                                <input type="number" name="qty_ng" class="form-control" value="{{ $data->qty_ng }}" required placeholder="Qty In"></input>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Remark</label>
                                <input type="text" name="remark" class="form-control" value="{{ $data->remark }}" required placeholder="Qty In"></input>
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
                    <td>{{ $data->loading->planing->tanggal }}</td>
                    <td>{{ $data->loading->planing->part_no }}</td>
                    <td>{{ $data->loading->planing->part_name }}</td>
                    <td>{{ $data->loading->lot_no }}</td>
                    <td>{{ $data->loading->hangger }}</td>
                    <td>{{ $data->loading->qty_in }}</td>
                    <td>{{ $data->qty_ok }}</td>
                    <td>{{ $data->qty_ng }}</td>
                    <td>{{ $data->remark }}</td>
                    <td class="d-flex flex-column flex-sm-row">
                        <button data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $data->id }}" class="btn btn-warning btn-sm mb-2 mb-sm-0 me-sm-2 bx bx-edit"></button>
                        <a href="{{ route('hapus.packing.admin',['id' => $data->id]) }}" class="btn btn-danger btn-sm bx bx-trash" data-confirm-delete="true"></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
