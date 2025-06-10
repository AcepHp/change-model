<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Edit Profile'])
    @include('layouts.head-css')

    <!-- DataTables CSS (jika memang dipakai di halaman ini) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<body>
    @include('layouts.layout-vertical')

    <div class="pc-container">
        <div class="pc-content">

            @include('layouts.breadcrumb', [
            'breadcrumbs' => [
            ['label' => 'Home', 'url' => '/dashboard', 'active' => false],
            ['label' => 'Edit Profile', 'url' => '#', 'active' => true],
            ]
            ])

            @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5>Edit Profile</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('update.profile') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                                class="form-control" required>
                            @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                                class="form-control">
                            @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="form-control" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password <small>(Kosongkan jika tidak ingin ganti)</small></label>
                            <input type="password" name="password" class="form-control">
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <a href="/dashboard" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @include('layouts/footer-block')
</body>

</html>