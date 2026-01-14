@extends('layouts.app')

@section('content')
    <style>
        .login-wrap {
            min-height: 100vh;
            background: radial-gradient(circle at top left, #e0f2fe 0%, #fef3c7 45%, #f5f6f8 100%);
        }
        .login-card {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
        }
        .login-brand {
            letter-spacing: 1px;
            font-weight: 700;
        }
    </style>

    <div class="container-fluid login-wrap d-flex align-items-center justify-content-center py-5">
        <div class="col-11 col-sm-10 col-md-6 col-lg-4">
            <div class="card login-card">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <div class="login-brand text-uppercase text-muted">Perpustakaan</div>
                        <h2 class="fw-bold mt-2 mb-1">Masuk</h2>
                        <p class="text-muted mb-0">Gunakan akun kamu untuk mengakses dashboard.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
