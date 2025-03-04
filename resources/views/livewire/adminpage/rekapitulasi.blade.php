<div>
    <div class="px-5">
        {{-- Alert --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Table --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Buku Rusak</h6>
            </div>
            <div class="card-body">
                {{-- Add Filter Controls --}}
                <div class="row mb-4">
                    <div class="col-md-3">
                        <select wire:model="tahun" class="form-control">
                            <option value="">Semua Tahun</option>
                            @for ($i = date('Y'); $i >= 2020; $i--)
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
                {{-- Download Button --}}
                <div class="mb-4">
                    <button wire:click="downloadPDF" class="btn btn-primary" >
                        <i class="bi bi-file-earmark-arrow-down mr-2"></i>Download PDF
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="rekapTable" width="100%" cellspacing="0">
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekapitulasi as $itemRekapitulasi)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $itemRekapitulasi->buku->judul }}</td>
                                    <td class="align-middle">{{ $itemRekapitulasi->buku->penulis }}</td>
                                    <td class="align-middle">{{ $itemRekapitulasi->buku->kategori->nama }}</td>
                                    <td class="align-middle text-center">{{ $itemRekapitulasi->buku->stok }}</td>
                                    <td class="align-middle text-center">{{ $itemRekapitulasi->rusak_ringan }}</td>
                                    <td class="align-middle text-center">{{ $itemRekapitulasi->rusak_sedang }}</td>
                                    <td class="align-middle text-center">{{ $itemRekapitulasi->rusak_berat }}</td>
                                    <td class="align-middle text-center">
                                        {{ $itemRekapitulasi->rusak_ringan + $itemRekapitulasi->rusak_sedang + $itemRekapitulasi->rusak_berat }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="align-middle text-center"><strong>Total</strong></td>
                                <td class="align-middle text-center font-weight-bold">{{ $totalJumlah }}</td>
                                <td class="align-middle text-center font-weight-bold">{{ $totalRusakRingan }}</td>
                                <td class="align-middle text-center font-weight-bold">{{ $totalRusakSedang }}</td>
                                <td class="align-middle text-center font-weight-bold">{{ $totalRusakBerat }}</td>
                                <td class="align-middle text-center font-weight-bold">{{ $totalRusak }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@section('script')
    <script>
        $(document).ready(function() {
            $('#rekapTable').DataTable();
        });

        let dataTable;

        function initializeDataTable() {
            if (dataTable) {
                dataTable.destroy();
            }
            dataTable = $('#rekapTable').DataTable();
        }

        document.addEventListener('livewire:load', function() {
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
