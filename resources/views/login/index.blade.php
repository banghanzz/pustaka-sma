@extends('layout.main')

@section('style')
<style>
    body {
        background: url('/assets/images/pustaka-soeman-hs.jpeg') no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.7);
            z-index: 0;
        }
    .card {
        width: 100%;
        max-width: 600px;
        position: relative;
        z-index: 1;
    }
</style>
@endsection

@section('content')
<div class="overlay"></div>
<div class="card shadow py-5 px-3 rounded-3">
    <div class="card-body">
        {{-- Logo --}}
        <div class="d-flex justify-content-center mb-4">
            <img src="{{ asset('/assets/images/tut-wuri-handayani.png') }}" alt="Logo" width="80" height="80">
        </div>

        {{-- Judul Card --}}
        <h4 class="text-center mb-4">Login ke Perpustakaan SMAN 3 Tualang</h4>
        <form>
            <!-- Email Input -->
            <div class="mb-3 position-relative">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="email" id="email" class="form-control" placeholder="Ketikkan email Anda" required>
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" id="password" class="form-control border-end-0" placeholder="Ketikkan password Anda" required>
                    <div class="input-group-append">
                        <button class="btn h-100 border border-start-0" style="border-radius: 0 10px 10px 0; border-color:#9e9e9e" type="button" id="togglePassword">
                            <i class="bi bi-eye-fill" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary fw-semibold">Login</button>
            </div>

            {{-- Belum Punya Akun? --}}
            <div class="info text-center">
                <p class="mt-4 mb-0 text-center text-secondary">
                    Belum punya akun Perpustakaan SMAN 3 Tualang ?
                </p>
                <a href="{{ url('/signup') }}" class="fw-semibold m-0 text-center text-decoration-none">
                    Daftar di sini
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        }
    });
</script>
@endsection