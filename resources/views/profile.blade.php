@extends('layouts.app')
@section('title', 'Profile')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Profil</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Hi, </h2>
        <p class="section-lead">
            Ubah informasi profil Anda di halaman ini.
        </p>

        <div class="row">
            <!-- Kolom Gambar Profil -->
            <div class="col-12 col-md-12 col-lg-5 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/img/avatar/avatar-1.png') }}" alt="Avatar" class="img-fluid rounded-circle mb-3" width="150">
                        <p class="text-muted"></p>
                    </div>
                </div>
            </div>

            <!-- Kolom Form Edit -->
            <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Edit Profil</h5>

                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="name" value="" class="form-control mb-3">

                                <label>Email</label>
                                <input type="email" name="email" value="" class="form-control mb-3">

                                <label>Password Baru</label>
                                <input type="password" name="password" class="form-control mb-3">

                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control mb-4">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">
                           <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
