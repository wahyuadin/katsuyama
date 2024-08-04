@extends('template.app')
@section('report', 'active')
@section('content')

{{-- @dd($data) --}}
<div class="card w-100">
    <div class="card-body">
        <div id="adobe-dc-view"></div>
        <div class="row">
            <div class="col-6 col-md-8">
                <h5 class="card-title">Halaman Print Tag</h5>
            </div>
            <div class="col-6 col-md-4">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('pdf.report.loading') }}" class="btn btn-primary"><i class='bx bx-printer'></i></a>
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
                    <td>
                        @isset($data->packing)
                            {{ $data->packing->time_out ?? '-' }}
                        @else
                            -
                        @endisset
                    </td>
                    <td>
                        @isset($data->packing->user)
                            {{ $data->packing->user->nama }}
                        @else
                            -
                        @endisset
                    </td>
                    <td>
                        {{ $data->packing->lot_no_edp ?? '-' }}
                    </td>
                    <td>
                        {{ $data->packing->qty_ok ?? '-' }}
                    </td>
                    <td>
                        {{ $data->packing->qty_ng ?? '-' }}
                    </td>
                    <td>
                        {{ $data->packing->remark ?? '-' }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
