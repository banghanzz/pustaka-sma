<div>
    {{-- Judul Halaman --}}
    <h2 class="mb-5 text-center">Kartu Perpustakaan</h2>

    <div class="row">
        <!-- Foto Anggota -->
        <div class="col-md-2 text-center">
            <img src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : asset('assets/images/avatar.jpg') }}" alt="" class="img-fluid w-100 rounded shadow">
        </div>

        <!-- Informasi Anggota -->
        <div class="col-md-10">
            <div class="card border-1 p-3">
                <div class="card-body">
                    <table class="table table-borderless m-0">
                        <tbody>
                            <tr>
                                <th class="text-start px-0" style="width: 16%;">Nama</th>
                                <td class="text-center" style="width: 2%;">:</td>
                                <td class="text-start">{{ Auth::user()->nama }}</td>
                            </tr>
                            <tr>
                                <th class="text-start px-0">NISN/NIP/NIK</th>
                                <td class="text-center">:</td>
                                <td class="text-start">{{ Auth::user()->nomor_induk }}</td>
                            </tr>
                            <tr>
                                <th class="text-start px-0">Email</th>
                                <td class="text-center">:</td>
                                <td class="text-start">{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <th class="text-start px-0">Nomor Telegram</th>
                                <td class="text-center">:</td>
                                <td class="text-start">{{ Auth::user()->nomor_telegram }}</td>
                            </tr>
                            <tr>
                                <th class="text-start px-0">Alamat</th>
                                <td class="text-center">:</td>
                                <td class="text-start">{{ Auth::user()->alamat }}</td>
                            </tr>
                            <tr>
                                <th class="text-start px-0">Level Pengguna</th>
                                <td class="text-center">:</td>
                                <td class="text-start">{{ Auth::user()->role->role }}</td>
                            </tr>
                            <tr>
                                <th class="text-start px-0">Kelas</th>
                                <td class="text-center">:</td>
                                <td class="text-start">{{ Auth::user()->kelas ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
