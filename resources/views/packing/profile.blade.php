@extends('template.app')
@section('content')
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
                    <li class="nav-item"><a class="nav-link active" href="#activity"
                            data-toggle="tab">Profile</a></li>
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
                                            <label>ID Card :</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <p id="nama"> {{ Auth::user()->id_card }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="nama" >Role :</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p id="nama">Operator {{ ucwords(Auth::user()->role) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="settings">
                        <form method="POST" action="{{ route('profile.packing.put', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputName" class="form-label">Nama :</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="{{ Auth::user()->nama }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputName2" class="form-label">ID Card :</label>
                                    <input type="text" class="form-control" name="id_card" placeholder="id_card" value="{{ Auth::user()->id_card}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputEmail" class="form-label">Role :</label>
                                    <input type="text" class="form-control" value="{{ Auth::user()->role }}" disabled>
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
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('profile.packing.put', ['id' => Auth::user()->id]) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="{{ Auth::user()->nama }}" readonly hidden>
                                        <input type="text" class="form-control" name="id_card" placeholder="id_card" value="{{ Auth::user()->id_card}}" readonly hidden>
                                        <div class="mb-3">
                                            <label for="disabledTextInput" class="form-label">Password Lama</label>
                                            <input type="password" name="password_lama" id="disabledTextInput" class="form-control" placeholder="Masukan Password Lama" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="disabledSelect" class="form-label">Password Baru</label>
                                            <input type="password" name="password" class="form-control" placeholder="Masukan Password Baru" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="disabledSelect" class="form-label">Re-Password Baru</label>
                                            <input type="password" name="repassword" class="form-control" placeholder="Masukan Kembali Password" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
@endsection
