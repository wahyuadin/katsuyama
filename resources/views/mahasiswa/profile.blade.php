@extends('template.app')
@section('content')
{{-- <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}"> --}}
{{-- modal Pengajuan --}}
<form method="POST" action="{{ route('pengajuanMentor.mahasiswa') }}" enctype="multipart/form-data">
@csrf
<div class="modal fade" id="pengajuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Pengajuan Pindah Mentor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Mentor</label>
                    <input type="text" class="form-control" value="{{ isset($data->first()->mentor->user->nama) ? $data->first()->mentor->user->nama : '' }}" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <input type="text" class="form-control" name="mentor_pertama" value="{{ isset($data->first()->mentor->id) ? $data->first()->mentor->id : '' }}" readonly hidden>
                <label for="inputEmail" class="form-label">Nama Mentor</label>
                <select class="form-select" name="mentor_kedua" aria-label="Default select example">
                    <option selected disabled>== Pilih Mentor ==</option>
                    @foreach ($mentor as $mentor)
                        <option value="{{ $mentor->id }}">{{ $mentor->user->nama }}</option>
                    @endforeach
                </select>
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
{{-- modal Password --}}
<form method="POST" action="{{ route('upload.mahasiswa', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
@csrf
@method('PUT')
<input type="text" readonly name="nama" value="{{ Auth::user()->nama }}" hidden>
<input type="text" readonly name="no_telp" value="{{ Auth::user()->no_telp }}" hidden>
<input type="text" readonly name="alamat" value="{{ Auth::user()->alamat }}" hidden>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ config('app.name') }} || Pengajuan</h5>
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
                        @if (!$pengajuan_mentor->isEmpty())
                            @if ($pengajuan_mentor->first()->status === "pending")
                            <div class="alert alert-warning">
                                <p>Pengajuan Mentor Vokasi sedang diproses.</p>
                            </div>
                            @elseif ($pengajuan_mentor->first()->status === "reject")
                            <div class="alert alert-danger">
                                <p>Pengajuan Mentor Vokasi Ditolak.</p>
                            </div>
                            @endif
                        @endif
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity"
                            data-toggle="tab">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Log Aktifitas</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
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
                                            <label>Nomor Induk Mahasiswa :</label>
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
                                            <p id="nama">+62 {{ Auth::user()->no_telp }}</p>
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
                                            <label for="nama" >Mentor Vokasi :</label>
                                        </div>
                                        <div class="col-md-8">
                                            {{-- @dd($data->first()->mentor->user->nama) --}}
                                            @if(isset($data->first()->mentor->user->nama))
                                                <p id="nama">
                                                    @if (!$pengajuan_mentor->isEmpty())
                                                        @if ($pengajuan_mentor->first()->status === "pending")
                                                            {{ $pengajuan_mentor->first()->mentorPertama->user->nama }} || {{ $pengajuan_mentor->first()->mentorKedua->user->nama }} <span class="badge rounded-pill bg-warning">Pending</span>
                                                        @else
                                                            {{ $data->first()->mentor->user->nama }} <button type="button" data-bs-toggle="modal" data-bs-target="#pengajuan" class="btn btn-info btn-xs rounded">Pindah</button>
                                                        @endif
                                                    @else
                                                    {{ $data->first()->mentor->user->nama }} <button type="button" data-bs-toggle="modal" data-bs-target="#pengajuan" class="btn btn-info btn-xs rounded">Pindah</button>
                                                    @endif
                                                </p>
                                            @else
                                                <p id="nama">Mentor Belum Diinputkan</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama" >Dosen Pembimbing :</label>
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
                                                <p style="inter-word;">Mengirim pesan kepada teman</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="#" class="float-right">Akun Jane Doe</a>
                                                <p style="inter-word;">Mengunggah foto profil baru</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="#" class="float-right">Akun Jane Doe</a>
                                                <p style="inter-word;">Mengunggah foto profil baru</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <a href="#" class="float-right">Akun Jane Doe</a>
                                                <p style="inter-word;">Mengirim pesan kepada teman</p>
                                            </div>
                                            @endforeach
                                        @endfor
                                        <div class="col-sm-4">
                                            <a href="#" class="float-right">Akun Jane Doe</a>
                                            <p style="inter-word;">Mengunggah foto profil baru</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="#" class="float-right">Akun Jane Doe</a>
                                            <p style="inter-word;">Mengunggah foto profil baru</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <h5>12 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun John Smith</a>
                                        <p style="inter-word;">Menambahkan postingan baru</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun John Smith</a>
                                        <p style="inter-word;">Mengomentari postingan teman</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>15 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Alice Johnson</a>
                                        <p style="inter-word;">Mengupdate status</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Alice Johnson</a>
                                        <p style="inter-word;">Mengirim pesan pribadi</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>18 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Robert Brown</a>
                                        <p style="inter-word;">Mengunggah video</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Robert Brown</a>
                                        <p style="inter-word;">Mengomentari video teman</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>20 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Emily Wilson</a>
                                        <p style="inter-word;">Membagikan postingan teman</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Emily Wilson</a>
                                        <p style="inter-word;">Menyukai foto teman</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>22 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Michael Clark</a>
                                        <p style="inter-word;">Mengomentari artikel</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Michael Clark</a>
                                        <p style="inter-word;">Menyimpan postingan</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>25 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Sophia Lee</a>
                                        <p style="inter-word;">Mengirim pesan ke grup</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Sophia Lee</a>
                                        <p style="inter-word;">Membagikan tautan artikel</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>28 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun David Rodriguez</a>
                                        <p style="inter-word;">Membuat acara baru</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun David Rodriguez</a>
                                        <p style="inter-word;">Mengundang teman ke acara</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>30 May, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Olivia Martinez</a>
                                        <p style="inter-word;">Mengomentari foto</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun Olivia Martinez</a>
                                        <p style="inter-word;">Menyukai video</p>
                                    </div>
                                </li>
                                <li>
                                    <h5>1 June, 2024</h5>
                                    <div class="">
                                        <a href="#" class="float-right">Akun William Taylor</a>
                                        <p style="inter-word;">Mengupdate informasi profil</p>
                                    </div>
                                    <div class="">
                                        <a href="#" class="float-right">Akun William Taylor</a>
                                        <p style="inter-word;">Mengganti foto sampul</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings">
                        <form method="POST" action="{{ route('upload.mahasiswa', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputName" class="form-label">Nama :</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="{{ Auth::user()->nama }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputName2" class="form-label">No Handphone :</label>
                                    <input type="number" class="form-control" name="no_telp" placeholder="Contact" value="{{ Auth::user()->no_telp }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Email :</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ Auth::user()->email }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Nomor Induk : </label>
                                    <input type="text" class="form-control" name="nomor_induk" placeholder="NIM" value="{{ Auth::user()->nomor_induk }}" readonly>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail" class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat" rows="4">{{ Auth::user()->alamat }}</textarea>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
