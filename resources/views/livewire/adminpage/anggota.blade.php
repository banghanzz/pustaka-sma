<div>
    <div class="px-5">
        {{-- Add Data Button --}}
        <div class="py-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahAnggotaModal">+ Anggota Perpustakaan</a>
        </div>

        {{-- Alert --}}
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Table --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Anggota Perpustakaan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="anggotaTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="1%">#</th>
                                <th class="" width="">Foto Anggota</th>
                                <th class="" width="">Nama Anggota</th>
                                <th class="" width="">NISN/NIP</th>
                                <th class="" width="">Alamat</th>
                                <th class="" width="">Email</th>
                                <th class="" width="">No Telegram</th>
                                <th class="" width="">Chat ID</th>
                                <th class="" width="">Level Anggota</th>                                
                                <th class="" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($anggota as $itemAnggota )
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle text-center">
                                    <img src="{{ $itemAnggota->foto_profil ? Storage::url($itemAnggota->foto_profil) : asset('assets/images/avatar.jpg') }}" 
                                         onerror="this.onerror=null;this.src='{{ asset('assets/images/avatar.jpg') }}';" 
                                         class="img-fluid rounded shadow" width="60px">
                                </td>
                                <td class="align-middle">{{ $itemAnggota->nama }}</td>
                                <td class="align-middle">{{ $itemAnggota->nomor_induk }}</td>
                                <td class="align-middle">{{ $itemAnggota->alamat }}</td>
                                <td class="align-middle">{{ $itemAnggota->email }}</td>
                                <td class="align-middle">{{ $itemAnggota->nomor_telegram }}</td>
                                <td class="align-middle">{{ $itemAnggota->chat_id ?? '-' }}</td>
                                <td class="align-middle">{{ $itemAnggota->role->role }}</td>
                                <td class="align-middle text-center">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100 mr-2" data-toggle="modal" data-target="#ubahAnggotaModal" wire:click="show({{ $itemAnggota->id }})">Ubah</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm w-100" data-toggle="modal" data-target="#hapusAnggotaModal" wire:click="show({{ $itemAnggota->id }})">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.adminpage.anggotaModal')
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#anggotaTable').DataTable();

        // Reinitialize DataTables when modal is closed
        $('#ubahAnggotaModal, #hapusAnggotaModal').on('hidden.bs.modal', function () {
            $('#anggotaTable').DataTable();
        });
    });

    // Listen for Livewire events to reinitialize DataTables
    Livewire.on('modalClosed', () => {
        $('#anggotaTable').DataTable();
    });

    // Menampilkan password dengan icon mata
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
    document.getElementById('roles_id').addEventListener('change', function () {
        const level = this.value;
        const kelasInput = document.getElementById('kelasInput');
        if (level === '4') {
            kelasInput.style.display = 'block';
        } else {
            kelasInput.style.display = 'none';
        }
    });
</script>
@endsection
