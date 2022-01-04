@extends('login.layout')
<!-- awal content -->
@section('content')


    <div class="row justify-content-center" style="width:100%;">
        <div class="col-md-4 bg-white rounded p-5">
        @if(session()->has('success'))
            <div class=" alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('loginError'))
            <div class=" alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

            <main>
                <h3 class="mb-4 fw-normal text-center">Please Login</h3>
                <form action="/login" method="post">

                @csrf

                    <div class="form-floating mb-2">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}" autofocus required>
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    

                    <button class="w-100 btn btn-lg btn-dark rounded-pill" type="submit">Login</button>
                </form>
                <small>Belum registrasi? <a href="/registrasi">Registrasi</a> sekarang!</small>
        </main>
        </div>
    </div>
    
    
@endsection
<!-- akhir content -->


