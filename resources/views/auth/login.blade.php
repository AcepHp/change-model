<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Login'])
    @include('layouts.head-css')
</head>

<body>
    @include('layouts.loader')

    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header text-center py-3">
                    <a href="#">
                        <img src="{{ asset('assets/images/AVI.png') }}" alt="img" class="img-fluid"
                            style="max-height: 40px;">
                    </a>
                </div>
                <div class="card my-5">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Login</b></h3>
                            <a href="{{ route('register') }}" class="link-primary">Don't have an account?</a>
                        </div>
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Username*</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                                    required>
                                @error('username')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password*</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>

                    </div>
                </div>

                <div class="auth-footer row">
                    
                </div>

            </div>
        </div>
    </div>

</body>

</html>