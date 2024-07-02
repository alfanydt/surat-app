@extends('layouts.auth')

@section('main')
    <main class="d-flex align-items-center min-vh-100 bg-dark" style="background: url('{{ asset('admin/assets/img/bg-bank.jpeg') }}') no-repeat center center; background-size: cover;">
        <div class="overlay position-absolute w-100 h-100" style="background-color: rgba(0, 0, 0, 0.2);"></div>
            <div class="container position-relative z-index-1">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <!-- Basic register form-->
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header text-center"><h3 class="fw-light my-4">E-Surat Register</h3></div>
                        <div class="card-body">
                            @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}    
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session()->has('registerError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('registerError') }}    
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            <!-- Register form-->
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <!-- Form Group (name)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter name" required/>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter email" required/>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (password)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Enter password" required/>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Form Group (password confirmation)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="password_confirmation">Confirm Password</label>
                                    <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm password" required/>
                                </div>
                                <!-- Form Group (register box)-->
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <div class="small">
                                <a href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
