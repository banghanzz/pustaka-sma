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
        height: 95vh;
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
    }
    .card-body {
        overflow-y: auto; /* Membuat konten di dalam card bisa discroll */
        flex-grow: 1; /* Membuat body card fleksibel agar memenuhi ruang */
        padding: 30px; 
    }
</style>
@endsection

@section('content')
<div class="overlay"></div>
<div class="card shadow py-3 px-3 rounded-3">
    <div class="card-body">
        {{-- Logo --}}
        <div class="d-flex justify-content-center mb-4">
            <img src="{{ asset('/assets/images/tut-wuri-handayani.png') }}" alt="Logo" width="80" height="80">
        </div>

        {{-- Judul Card --}}
        <h4 class="text-center mb-4">Daftar Akun Perpustakaan SMAN 3 Tualang</h4>

        {{-- Belum Punya Akun? --}}
        <div class="info text-center mb-4">
            <p class="mt-4 mb-0 text-center text-secondary">
                Sudah punya akun Perpustakaan SMAN 3 Tualang ?
            </p>
            <a href="{{ url('/login') }}" class="fw-semibold m-0 text-center text-decoration-none">
                Login di sini
            </a>
        </div>

        <form>
            <!-- Nama Input -->
            <div class="mb-3 position-relative">
                <label for="name" class="form-label">Nama</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" id="name" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>
            </div>

            <!-- NISN/NIK Input -->
            <div class="mb-3 position-relative">
                <label for="nisn" class="form-label">NISN/NIK</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                    <input type="text" id="nisn" class="form-control" placeholder="Masukkan NISN atau NIK" required>
                </div>
            </div>

            <!-- Alamat Input -->
            <div class="mb-3 position-relative">
                <label for="address" class="form-label">Alamat</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-house-door-fill"></i></span>
                    <input type="text" id="address" class="form-control" placeholder="Masukkan alamat lengkap" required>
                </div>
            </div>

            <!-- Nomor Telegram Input -->
            <div class="mb-3 position-relative">
                <label for="telegram" class="form-label">Nomor Telegram</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-chat-left-text-fill"></i></span>
                    <input type="text" id="telegram" class="form-control" placeholder="Masukkan nomor Telegram" required>
                </div>
            </div>

            <!-- Level Pengguna Input -->
            <div class="mb-3 position-relative">
                <label for="level" class="form-label">Level Pengguna</label>
                <select id="level" class="form-select" required>
                    <option value="" disabled selected>Pilih Level Pengguna</option>
                    <option value="1">Guru</option>
                    <option value="2">Siswa</option>
                </select>
            </div>

            <!-- Kelas Input (Hanya untuk siswa) -->
            <div class="mb-3 position-relative" id="kelasInput" style="display: none;">
                <label for="class" class="form-label">Kelas</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-clipboard-data-fill"></i></span>
                    <input type="text" id="class" class="form-control" placeholder="Masukkan kelas" required>
                </div>
            </div>

            <!-- Pas Foto Input -->
            <div class="mb-3 position-relative">
                <label for="photo" class="form-label">Pas Foto</label>
                <input type="file" id="photo" class="form-control" accept="image/*" required>
            </div>

            <!-- Email Input -->
            <div class="mb-3 position-relative">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" id="email" class="form-control" placeholder="Masukkan email" required>
                </div>
            </div>

            <!-- Password Input -->
            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" id="password" class="form-control border-end-0" placeholder="Masukkan password" required>
                    <div class="input-group-append">
                        <button class="btn h-100 border border-start-0" style="border-radius: 0 10px 10px 0; border-color:#9e9e9e" type="button" id="togglePassword">
                            <i class="bi bi-eye-fill" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Ulangi Password Input -->
            <div class="mb-3 position-relative">
                <label for="confirm_password" class="form-label">Ulangi Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" id="confirm_password" class="form-control border-end-0" placeholder="Masukkan ulang password" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary fw-semibold">Daftar Akun</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    // 
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm_password');
        const icon = this.querySelector('i');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            confirmPasswordInput.type = 'text';
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        } else {
            passwordInput.type = 'password';
            confirmPasswordInput.type = 'password';
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        }
    });

    // Menampilkan input Kelas hanya untuk Level Pengguna "Siswa"
    document.getElementById('level').addEventListener('change', function () {
        const level = this.value;
        const kelasInput = document.getElementById('kelasInput');
        if (level === '2') {
            kelasInput.style.display = 'block';
        } else {
            kelasInput.style.display = 'none';
        }
    });
</script>
@endsection
