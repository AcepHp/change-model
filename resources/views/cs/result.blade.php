<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Hasil Filter Data CS Change Model'])
    @include('layouts.head-css')

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <style>
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
    }

    .dataTables_wrapper .dataTables_length select {
        display: inline-block;
        width: auto;
    }
    </style>
</head>

<body>
    @include('layouts.layout-vertical')

    <div class="pc-container">
        <div class="pc-content">
            @include('layouts.breadcrumb', [
            'breadcrumbs' => [
            ['label' => 'Home', 'url' => '/dashboard', 'active' => false],
            ['label' => 'Filter Data', 'url' => '/cs-change-model', 'active' => false],
            ['label' => 'Data CS Change Model', 'url' => '/cs-change-model', 'active' => true],
            ]
            ])

            <div class="card p-4">
                <form action="{{ route('cs.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="area" value="{{ request('area') }}">
                    <input type="hidden" name="line" value="{{ request('line') }}">
                    <input type="hidden" name="model" value="{{ request('model') }}">
                    <input type="hidden" name="shift" value="{{ request('shift') }}">
                    <input type="hidden" name="date" value="{{ request('date') }}">

                    <div class="table-responsive">
                        <table id="table-data-cs" class="display responsive nowrap table table-bordered"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th style="max-width: 30px;">List</th>
                                    <th style="max-width: 40px;">Station</th>
                                    <th>Check Item</th>
                                    <th>Standard</th>
                                    <th>Actual</th>
                                    <th>Trigger</th>
                                    <th style="max-width: 65px;">Scan Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <td style="display: none">{{ $item->id }}</td> {{-- ID disembunyikan --}}

                                    <td data-label="List">
                                        {{ $item->list }}
                                        <input type="hidden" name="data[{{ $item->id }}][list]"
                                            value="{{ $item->list }}">
                                    </td>

                                    <td data-label="Station">
                                        {{ $item->station }}
                                        <input type="hidden" name="data[{{ $item->id }}][station]"
                                            value="{{ $item->station }}">
                                    </td>

                                    <td data-label="Check Item">
                                        {{ $item->check_item }}
                                        <input type="hidden" name="data[{{ $item->id }}][check_item]"
                                            value="{{ $item->check_item }}">
                                    </td>

                                    <td data-label="Standard">
                                        {{ $item->standard }}
                                        <input type="hidden" name="data[{{ $item->id }}][standard]"
                                            value="{{ $item->standard }}">
                                    </td>

                                    <td data-label="Actual">
                                        <select name="data[{{ $item->id }}][actual]"
                                            class="form-select form-select-sm actual-select">
                                            <option value="" disabled selected>Pilih Aksi</option>
                                            <option value="Check">Check</option>
                                            <option value="Scan">Scan</option>
                                        </select>
                                        <input type="hidden" name="data[{{ $item->id }}][scan_result]"
                                            class="scan-result-hidden" />
                                    </td>

                                    <td data-label="Trigger">{{ $item->trigger }}</td>

                                    <td class="scan-result-cell" data-id="{{ $item->id }}" data-label="Scan Result">-
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data ditemukan</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    @include('layouts.footer-block')

    <!-- Modal Kamera Scan -->
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan QR/Barcode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="qr-reader" style="width: 100%;"></div>
                    <button type="button" id="swapCameraBtn" class="btn btn-secondary btn-sm mt-2">Swap Kamera</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
    $(document).ready(function() {
        const table = $('#table-data-cs').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: true,
            pageLength: 10,
            columnDefs: [{
                    targets: 0,
                    visible: false
                }, // Sembunyikan kolom ID
                {
                    responsivePriority: 1,
                    targets: 1
                }, // List tampil paling prioritas
                {
                    responsivePriority: 2,
                    targets: 2
                }, // Station prioritas kedua
                {
                    responsivePriority: 3,
                    targets: -1
                } // Scan Result prioritas ketiga
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari data...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                }
            }
        });


        // Simpan nilai setiap kali dropdown berubah
        $('#table-data-cs').on('change', 'select.actual-select', function() {
            const selected = $(this).val();
            const row = $(this).closest('tr');

            let cellElement, hiddenInput;

            // Ambil elemen dari parent row jika ini child
            const parentRow = row.hasClass('child') ? row.prev() : row;

            // Simpan ke hidden input
            parentRow.find('.actual-select').val(selected);

            // Juga simpan ke clone di child row (jika ada)
            const childRow = parentRow.next();
            if (childRow.hasClass('child')) {
                childRow.find('.actual-select').val(selected);
            }

            // Update scan jika dipilih
            if (selected === 'Scan') {
                const scanCell = parentRow.find('.scan-result-cell');
                const hiddenScan = parentRow.find('.scan-result-hidden');
                startScanner(scanCell, hiddenScan);
            }
        });

    });
    </script>

    <!-- QR Scanner Script -->
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
    let html5QrCode = null;
    let currentFacingMode = "environment";
    let scannerRunning = false;

    function startScanner(cellElement, hiddenInput) {
        $('#scanModal').modal('show');

        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then(function(stream) {
                stream.getTracks().forEach(track => track.stop());

                if (html5QrCode) {
                    html5QrCode.clear();
                }

                html5QrCode = new Html5Qrcode("qr-reader");
                html5QrCode.start({
                        facingMode: currentFacingMode
                    }, {
                        fps: 10,
                        qrbox: 250
                    },
                    (decodedText, decodedResult) => {
                        $(cellElement).text(decodedText);
                        $(hiddenInput).val(decodedText);
                        stopScanner();
                    },
                    (errorMessage) => {
                        // optional error log
                    }
                ).then(() => {
                    scannerRunning = true; // <- Tambahkan ini setelah start berhasil
                }).catch(err => {
                    alert("Gagal memulai kamera: " + err);
                });
            })
            .catch(function(err) {
                alert("Izin kamera ditolak atau tidak tersedia: " + err);
                $('#scanModal').modal('hide');
            });
    }



    function stopScanner() {
        if (html5QrCode && scannerRunning) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                scannerRunning = false; // <- Tambahkan ini
                $('#scanModal').modal('hide');
            }).catch((err) => {
                console.warn("Gagal menghentikan scanner:", err);
            });
        }
    }


    $('#swapCameraBtn').on('click', function() {
        currentFacingMode = (currentFacingMode === "environment") ? "user" : "environment";

        if (html5QrCode && scannerRunning) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                scannerRunning = false;

                html5QrCode.start({
                        facingMode: currentFacingMode
                    }, {
                        fps: 10,
                        qrbox: 250
                    },
                    () => {},
                    () => {}
                ).then(() => {
                    scannerRunning = true;
                });
            });
        }
    });


    $('#scanModal').on('hidden.bs.modal', function() {
        stopScanner();
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace();
    </script>
</body>

</html>