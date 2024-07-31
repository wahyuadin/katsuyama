@extends('template.app')
@section('loading', 'active')
@section('content')

<div class="card w-100">
    <div class="card-body">
        <div id="adobe-dc-view"></div>
        <div class="row">
            <div class="col-6 col-md-8">
                <h5 class="card-title">Halaman Loading</h5>
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
                    </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach($data as $data)
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
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
