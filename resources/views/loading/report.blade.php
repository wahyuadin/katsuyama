@extends('template.app')
@section('report', 'active')
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
                <h5 class="card-title">Halaman Print Tag</h5>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><i class='bx bx-printer'></i></button>
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#print" style="margin-left: 2px"><i class='bx bx-filter-alt' ></i></button>
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
                        <th colspan="9"><center>OPEATOR LOADING</center></th>
                        <th colspan="6"><center>OPERATOR PACKING</center></th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Operator Loading</th>
                        <th>Tanggal</th>
                        <th>Part No</th>
                        <th>Part Name</th>
                        <th>Lot No</th>
                        <th>Hanggar (TYPE/QTY)</th>
                        <th>Qty In</th>
                        <th>Time In</th>
                        {{-- end loading --}}
                        <th>Time Out</th>
                        <th>Operator Packing</th>
                        <th>Lot_No_EDP</th>
                        <th>qty_ok</th>
                        <th>qty_ng</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($data as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->loading->user->nama }}</td>
                    <td>{{ $data->loading->planing->tanggal }}</td>
                    <td>{{ $data->loading->planing->part_no }}</td>
                    <td>{{ $data->loading->planing->part_name }}</td>
                    <td>{{ $data->loading->lot_no }}</td>
                    <td>{{ $data->loading->hanger->type }} / {{ $data->loading->hanger->qty }}</td>
                    <td>{{ $data->loading->qty_in }}</td>
                    <td>{{ $data->loading->time_in }}</td>
                    {{-- packing --}}
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
