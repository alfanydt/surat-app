@extends('layouts.auth')

@section('main')
    <main class="d-flex align-items-center min-vh-100 bg-dark" style="background: url('{{ asset('admin/assets/img/bg-bank.jpeg') }}') no-repeat center center; background-size: cover;">
        <div class="overlay position-absolute w-100 h-100" style="background-color: rgba(0, 0, 0, 0.2);"></div>
            <div class="container position-relative z-index-1">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <!-- Basic login form-->
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header text-center"><h3 class="fw-light my-4">E-Surat</h3></div>
                        <div class="card-body">
                            @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}    
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}    
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <!-- Login form-->
                            <form action="/login" method="post">
                                @csrf
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter email" autofocus required/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Enter password" required/>
                                </div>
                                <!-- Form Group (remember password checkbox)-->
                                <div class="mb-3 form-check">
                                    <input class="form-check-input" id="rememberPasswordCheck" type="checkbox" />
                                    <label class="form-check-label" for="rememberPasswordCheck">Remember me</label>
                                </div>
                                <!-- Form Group (login box)-->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <div class="small">
                                {{-- <a href="/">
                                    <i class="fas fa-arrow-left"></i> Back to Texno.id
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
