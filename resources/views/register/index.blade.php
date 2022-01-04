@extends('login.layout')
<!-- awal content -->
@section('content')


<div class="row justify-content-center mx-2 w-100">
        <div class="col-lg-5 bg-white rounded p-5">
            <main>
                <h3 class="mb-4 fw-normal text-center">Form Registrasi</h3>
                <form action="/registrasi" method="post">
                    @csrf
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ old('name') }}" required>
                        <label for="name">Name</label>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username') }}" required >
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button class="w-100 btn btn-lg btn-dark rounded-pill" type="submit">Registrasi</button>
                </form>
                <small>Sudah registrasi <a href="/login">Login</a> sekarang!</small>
        </main>
        </div>
    </div>


@endsection
<!-- akhir content -->