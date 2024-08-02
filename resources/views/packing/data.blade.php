@extends('template.app')
@section('packing', 'active')
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
        <form action="{{ route('operator.packing.tambah') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" value="{{ Auth::user()->nama }}" required readonly>
                <input type="text" name="user_id" class="form-control" value="{{ Auth::user()->id }}" required readonly hidden>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Loading</label>
                <select name="loading_id" class="form-control" required>
                    <option selected disabled>== Pilih Salah Satu ==</option>
                    @foreach ($loading as $loadingItem)
                        <option value="{{ $loadingItem->id }}">Tanggal: {{ $loadingItem->planing->tanggal }}, Penanggung jawab: {{ $loadingItem->user->nama }}, Part Number: {{ $loadingItem->planing->part_no}}, Part Name: {{ $loadingItem->planing->part_name}}, Lot No: {{ $loadingItem->lot_no}}, QTY In: {{ $loadingItem->qty_in, }}, Time Input: {{ $loadingItem->time_in }}</option>
                        {{-- <option value="{{ $loadingItem->id }}">Tanggal: {{ $loadingItem->planing->tanggal }}, Penanggung jawab: {{ $loadingItem->user->nama }}, Part Number: {{ $loadingItem->planing->part_no}}, Part Name: {{ $loadingItem->planing->part_name}}, QTY: {{ $loadingItem->planing->qty}}</option> --}}
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Lot No EDP</label>
                <input type="number" name="lot_no_edp" class="form-control" value="{{ old('lot_no_edp') }}" required placeholder="Lot No EDP"></input>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">QTY OK</label>
                <input type="number" name="qty_ok" class="form-control" value="{{ old('qty_ok') }}" required placeholder="QTY OK"></input>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">QTY NG</label>
                <input type="number" name="qty_ng" class="form-control" value="{{ old('qty_ng') }}" required placeholder="QTY NG"></input>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Remark</label>
                <textarea class="form-control" name="remark" rows="5">{{ old('remark') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Time Output</label>
                <input type="time" name="time_out" class="form-control" value="{{ old('time_out') }}" required placeholder="Time Input"></input>
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
                <h5 class="card-title">Halaman Packing</h5>
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
                        <th>Operator Packing</th>
                        <th>Operator Loading</th>
                        <th>Part No</th>
                        <th>Part Name</th>
                        <th>Lot No</th>
                        <th>Lot No EDP</th>
                        <th>QTY OK</th>
                        <th>QTY NG</th>
                        <th>Remark</th>
                        <th>Time Input</th>
                        <th>Time Output</th>
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
                        <form action="{{ route('operator.packing.edit', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama Karyawan</label>
                                <input type="text" class="form-control" value="{{ $data->user->nama }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Penanggung Jawab Operator Loading</label>
                                <input type="text" class="form-control" value="{{ $data->loading->user->nama }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Part No</label>
                                <input type="text" class="form-control" value="{{ $data->loading->planing->part_no }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Part Name</label>
                                <input type="text" class="form-control" value="{{ $data->loading->planing->part_name }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Lot No</label>
                                <input type="text" class="form-control" value="{{ $data->loading->lot_no }}" required readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Time Input</label>
                                <input type="text" class="form-control" value="{{ $data->loading->time_in }}" required readonly>
                            </div>
                            <hr>
                            <input type="text" name="user_id" value="{{ Auth::user()->id }}" readonly hidden>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Loading</label>
                                <select name="loading_id" class="form-control" required>
                                    <option selected disabled>== Pilih Salah Satu ==</option>
                                    @foreach ($loading as $loadingData)
                                        <option value="{{ $loadingData->id }}">Tanggal: {{ $loadingData->planing->tanggal }}, Penanggung jawab: {{ $loadingData->user->nama }}, Part Number: {{ $loadingData->planing->part_no}}, Part Name: {{ $loadingData->planing->part_name}}, Lot No: {{ $loadingData->lot_no}}, QTY In: {{ $loadingData->qty_in, }}, Time Input: {{ $loadingData->time_in }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Lot No EDP</label>
                                <input type="number" name="lot_no_edp" class="form-control" value="{{ $data->lot_no_edp }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">QTY OK</label>
                                <input type="number" name="qty_ok" class="form-control" value="{{ $data->qty_ok }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">QTY NG</label>
                                <input type="number" name="qty_ng" class="form-control" value="{{ $data->qty_ng }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Remark</label>
                                <textarea class="form-control" name="remark" rows="5">{{ $data->remark }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Time Output</label>
                                <input type="time" name="time_out" class="form-control" value="{{ $data->time_out }}" required placeholder="Time Input"></input>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>
                {{-- end modal --}}
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->user->nama }}</td>
                    <td>{{ $data->loading->user->nama }}</td>
                    <td>{{ $data->loading->planing->part_no }}</td>
                    <td>{{ $data->loading->planing->part_name }}</td>
                    <td>{{ $data->loading->lot_no }}</td>
                    <td>{{ $data->lot_no_edp }}</td>
                    <td>{{ $data->qty_ok }}</td>
                    <td>{{ $data->qty_ng }}</td>
                    <td>{{ $data->remark }}</td>
                    <td>{{ $data->loading->time_in }}</td>
                    <td>{{ $data->time_out }}</td>
                    <td class="d-flex flex-column flex-sm-row">
                        <button data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $data->id }}" class="btn btn-warning btn-sm mb-2 mb-sm-0 me-sm-2 bx bx-edit"></button>
                        {{-- <a href="{{ route('operator.packing.hapus',['id' => $data->id]) }}" class="btn btn-danger btn-sm bx bx-trash" data-confirm-delete="true"></a> --}}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
