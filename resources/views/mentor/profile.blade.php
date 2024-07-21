@extends('template.app')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}"> --}}
<!-- Modal Tambah Leader -->
<div class="modal fade" id="tambahLeader" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Tambah Leader</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('profile.mentor_vokasi.leader_post') }}" method="POST">
        <div class="modal-body">
            @csrf
            <div class="col-md-12">
                <label for="inputEmail" class="form-label">Nama Leader</label>
                <input type="text" class="form-control" name="leader" placeholder="Masukan Nama Leader" value="{{ old('leader') }}" required autofocus>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  {{-- end modal --}}
{{-- modal password --}}
<form method="POST" action="{{ route('upload.mentor_vokasi', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Ubah Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <label for="inputEmail" class="form-label">Password Lama</label>
                <input type="password" class="form-control" name="password_lama" placeholder="Masukan Password" value="{{ old('password') }}" required autofocus>
            </div>
            <div class="col-md-12 mt-2">
                <label for="inputEmail" class="form-label">Password Baru</label>
                <input type="password" class="form-control" name="password" placeholder="Masukan Re-Password" value="{{ old('repassword') }}" required>
            </div>
            <div class="col-md-12 mt-2">
                <label for="inputEmail" class="form-label">Re-Password</label>
                <input type="password" class="form-control" name="repassword" placeholder="Masukan Kembali Password Baru" value="{{ old('repassword') }}" required>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
    </div>
</div>
</form>
{{-- end modal --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-2">
                @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#activity" data-toggle="tab">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#timeline" data-toggle="tab">Log Aktifitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <div class="post">
                            <div class="row">
                                <div class="col-md-3 d-flex justify-content-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/img/profile/'. Auth::user()->foto_profile) }}" height="200" width="200" alt="Foto Profil" class="img-fluid rounded-circle mb-4">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="nama" >Nama :</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p style="text-transform: uppercase;"> {{ Auth::user()->nama }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Nomor Induk Dosen :</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p id="nama"> {{ Auth::user()->nomor_induk }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama" >Email :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="nama"> {{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama" >Nomor Telp :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="nama"> {{ Auth::user()->no_telp }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama" >Alamat :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="nama"> {{ Auth::user()->alamat }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama" >Leader :</label>
                                        </div>
                                        @if ($data->isEmpty())
                                        <div class="col-md-8">
                                            <p style="color: red">  {{ isset($data->first()->leader) ? 'Bpk/Ibu '. $data->first()->leader : 'Input Leader Untuk Mengakses' }} <button type="button" data-bs-toggle="modal" data-bs-target="#tambahLeader" class="btn btn-primary btn-xs rounded">Tambah</button></p>
                                        </div>
                                        @else
                                        <div class="col-md-8">
                                            <p id="nama">Bpk/Ibu . {{ $data->first()->leader }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama" >Section :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="nama"> {{ $faker->name() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="timeline">
                        <div class="col-sm-12">
                            <ul class="timeline">
                                <li>
                                    <h5>10 May, 2024</h5>
                                    <div class="row">
                                        @for ($i = 1; $i <= 10; $i++)
                                            @foreach ($faker as $faker)
                                            <div class="col-sm-4">
                                                <a href="#" class="float-right">{{ $faker->name }}</a>
                                                <p style="text-align: justify; text-justify: inter-word;">Mengirim pesan kepada teman</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="#" class="float-right">Akun Jane Doe</a>
                                                <p style="text-align: justify; text-justify: inter-word;">Mengunggah foto profil baru</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="#" class="float-right">Akun Jane Doe</a>
                                                <p style="text-align: justify; text-justify: inter-word;">Mengunggah foto profil baru</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="#" class="float-right">Akun Jane Doe</a>
                                                <p style="text-align: justify; text-justify: inter-word;">Mengirim pesan kepada teman</p>
                                            </div>
                                            @endforeach
                                        @endfor
                                        <div class="col-sm-4">
                                            <a href="#" class="float-right">Akun Jane Doe</a>
                                            <p style="text-align: justify; text-justify: inter-word;">Mengunggah foto profil baru</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="#" class="float-right">Akun Jane Doe</a>
                                            <p style="text-align: justify; text-justify: inter-word;">Mengunggah foto profil baru</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <h5>12 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun John Smith</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Menambahkan postingan baru</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun John Smith</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengomentari postingan teman</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>15 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Alice Johnson</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengupdate status</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Alice Johnson</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengirim pesan pribadi</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>18 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Robert Brown</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengunggah video</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Robert Brown</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengomentari video teman</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>20 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Emily Wilson</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Membagikan postingan teman</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Emily Wilson</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Menyukai foto teman</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>22 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Michael Clark</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengomentari artikel</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Michael Clark</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Menyimpan postingan</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>25 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Sophia Lee</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengirim pesan ke grup</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Sophia Lee</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Membagikan tautan artikel</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>28 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun David Rodriguez</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Membuat acara baru</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun David Rodriguez</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengundang teman ke acara</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>30 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Olivia Martinez</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengomentari foto</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Olivia Martinez</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Menyukai video</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>1 June, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun William Taylor</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengupdate informasi profil</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun William Taylor</a>
                                        <p style="text-align: justify; text-justify: inter-word;">Mengganti foto sampul</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings">
                        @if (!$data->isEmpty())
                        <form method="POST" action="{{ route('upload.mentor_vokasi', ['id' => $data->value('id')]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputName" class="form-label">Nama :</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="{{ $data->first()->user->nama }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputName2" class="form-label">No Handphone :</label>
                                    <input type="number" class="form-control" name="no_telp" placeholder="Contact" value="{{ $data->first()->user->no_telp }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Email :</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $data->first()->user->email }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Nomor Induk : </label>
                                    <input type="text" class="form-control" name="nomor_induk" placeholder="Nomor Induk" value="{{ $data->first()->user->nomor_induk }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail" class="form-label">Leader : </label>
                                    <input type="text" class="form-control" name="leader" placeholder="leader" value="{{ $data->first()->leader }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="4">{{ $data->first()->user->alamat }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label for="inputSkills" class="form-label">Foto Profile</label>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('assets/img/profile/'. Auth::user()->foto_profile) }}" height="200" width="200" alt="Foto Profil" class="img-fluid rounded-circle mb-4">
                                    </div>
                                    <input type="file" class="form-control" name="foto_profile" accept="image/*">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-danger mb-2 mb-sm-0 me-sm-2">Submit</button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary mb-2 mb-sm-0 me-sm-2">
                                        Ubah Password
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
