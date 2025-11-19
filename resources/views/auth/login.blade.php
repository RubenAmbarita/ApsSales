@extends('layouts.auth')

@section('content')


<!-- Login Form -->
 <a href="{{ url('/') }}" class="back-home-btn">
    ← Kembali
</a>

<div class="login-card">
    <img src="{{ asset('frontend/images/logodjki.png') }}" alt="Logo DJKI" class="img-fluid">
    <h5>SIMANTAP<br><small>Direktorat Teknologi Informasi - DJKI</small></h5>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- NIP -->
        <div class="mb-3 text-start">
            <label for="nip" class="form-label">NIP</label>
            <input id="nip" class="form-control @error('nip') is-invalid @enderror"
                   name="nip" value="{{ old('nip') }}" required autocomplete="nip" autofocus
                   placeholder="Masukkan NIP Anda">
            @error('nip')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <!-- Password with Eye Icon -->
        <div class="mb-3 text-start position-relative">
            <label for="password" class="form-label">Password</label>
            <div class="position-relative">
                <input id="password" type="password" 
                       class="form-control pe-5 @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password" 
                       placeholder="Masukkan Password">
                <span class="toggle-password" onclick="togglePassword()">
                    <i class="bi bi-eye-slash" id="eyeIcon"></i>
                </span>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Masuk</button>
    </form>

    <div class="login-footer">
        © 2025 SIMANTAP - Direktorat Teknologi Informasi DJKI
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- Script -->
<script>
function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    } else {
        password.type = 'password';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    }
}
</script>
@endsection
