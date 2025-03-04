<div>
    <div class="px-5">
        {{-- Add Data Button --}}
        <div class="py-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahBukuRusakModal">+ Data Buku Rusak</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Buku Rusak</h6>
            </div>
            <div class="card-body">
                {{-- Add Filter Controls --}}
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select wire:model="tahun" class="form-control">
                            <option value="">Semua Tahun</option>
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select wire:model="bulan" class="form-control">
                            <option value="">Semua Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button wire:click="applyFilter" class="btn btn-primary">
                            Filter
                        </button>
                        <button wire:click="resetFilter" class="btn btn-outline-primary ml-2">
                            Bulan ini
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="bukuRusakTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="1%">#</th>
                                <th class="" width="">Judul Buku</th>
                                <th class="" width="">Penulis</th>
                                <th class="" width="">Kategori</th>
                                <th class="" width="">Jumlah Buku</th>
                                <th class="" width="">Rusak Ringan</th>
                                <th class="" width="">Rusak Sedang</th>
                                <th class="" width="">Rusak Berat</th>
                                <th class="" width="">Total Rusak</th>
                                <th class="" width="">Tanggal Pencatatan</th>
                                <th class="" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bukurusak as $itemBukuRusak )    
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $itemBukuRusak->buku->judul }}</td>
                                <td class="align-middle">{{ $itemBukuRusak->buku->penulis }}</td>
                                <td class="align-middle">{{ $itemBukuRusak->buku->kategori->nama }}</td>
                                <td class="align-middle text-center">{{ $itemBukuRusak->buku->stok }}</td>
                                <td class="align-middle text-center">{{ $itemBukuRusak->rusak_ringan }}</td>
                                <td class="align-middle text-center">{{ $itemBukuRusak->rusak_sedang }}</td>
                                <td class="align-middle text-center">{{ $itemBukuRusak->rusak_berat }}</td>
                                <td class="align-middle text-center">{{ $itemBukuRusak->rusak_ringan + $itemBukuRusak->rusak_sedang + $itemBukuRusak->rusak_berat }}</td>
                                <td class="align-middle text-center">{{ date('d-m-Y', strtotime($itemBukuRusak->tanggal_pencatatan)) }}</td>
                                <td class="align-middle d-flex">
                                    <button type="button" class="btn btn-outline-primary btn-sm w-100 mr-2" data-toggle="modal" data-target="#ubahBukuRusakModal" wire:click="show({{ $itemBukuRusak->id }})">Ubah</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm w-100" data-toggle="modal" data-target="#hapusBukuRusakModal" wire:click="show({{ $itemBukuRusak->id }})">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.adminpage.bukurusakModal')
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#bukuRusakTable').DataTable();

        // Reinitialize DataTables when modal is closed
        $('#ubahBukuRusakModal, #hapusBukuRusakModal').on('hidden.bs.modal', function () {
            $('#bukuRusakTable').DataTable();
        });
    });

    // Listen for Livewire events to reinitialize DataTables
    Livewire.on('modalClosed', () => {
        $('#bukuRusakTable').DataTable();
    });

    let dataTable;
    
    function initializeDataTable() {
        if (dataTable) {
            dataTable.destroy();
        }
        dataTable = $('#bukuRusakTable').DataTable();
    }

    document.addEventListener('livewire:load', function () {
        initializeDataTable();
    });

    document.addEventListener('livewire:initialized', () => {
        Livewire.on('dataUpdated', () => {
            setTimeout(() => {
                initializeDataTable();
            }, 100);
        });
    });
</script>
@endsection