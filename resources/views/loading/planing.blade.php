@extends('template.app')
@section('planing', 'active')
@section('content')

<div class="card w-100">
    <div class="card-body">
        <div id="adobe-dc-view"></div>
        <div class="row">
            <div class="col-6 col-md-8">
                <h5 class="card-title">Halaman Planing</h5>
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
                        <th>Admin</th>
                        <th>Tanggal</th>
                        <th>Part No</th>
                        <th>Part Name</th>
                        <th>Qty</th>
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
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->part_no }}</td>
                    <td>{{ $data->part_name }}</td>
                    <td>{{ $data->qty }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
  </div>
@endsection
