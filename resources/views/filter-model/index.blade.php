<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Filter dan Input Checksheet'])
    @include('layouts.head-css')

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.bootstrap5.min.css">
    <!-- SweetAlert2 for beautiful popups -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
    /* Styling area scanner */
    .barcode-scanner {
        position: relative;
        width: 320px;
        height: 240px;
        border: 2px solid #007bff;
        border-radius: 8px;
        margin-top: 10px;
        background: #000;
        overflow: hidden;
    }

    .barcode-scanner video {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 8px;
    }

    .scanner-controls {
        margin-top: 5px;
        display: flex;
        gap: 5px;
    }

    .scan-result {
        font-weight: 600;
        color: green;
    }

    .scan-error {
        color: red;
        font-weight: 600;
    }

    /* Loading spinner */
    .loading-spinner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid #007bff;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        animation: spin 1s linear infinite;
        z-index: 100;
        display: none;
    }

    @keyframes spin {
        0% {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        100% {
            transform: translate(-50%, -50%) rotate(360deg);
        }
    }
    </style>
</head>

<body @@bodySetup>
    @include('layouts.layout-vertical')

    <div class="pc-container">
        <div class="pc-content">
            @include('layouts.breadcrumb', [
            'breadcrumbs' => [
            ['label' => 'Home', 'url' => '/dashboard', 'active' => false],
            ['label' => 'Filter Checksheet', 'url' => url()->current(), 'active' => true],
            ]
            ])

            <div class="card">
                <div class="card-header">
                    <h5>Filter dan Input Checksheet</h5>
                </div>
                <div class="card-body">

                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('filter-model.index') }}" method="GET" class="row g-3 mb-4">
                        <div class="col-md-2">
                            <label for="area" class="form-label">Area</label>
                            <select name="area" id="area" class="form-select" required>
                                <option value="">Pilih Area</option>
                                @foreach($areas as $area)
                                <option value="{{ $area }}" {{ (request('area') == $area) ? 'selected' : '' }}>
                                    {{ $area }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="line" class="form-label">Line</label>
                            <select name="line" id="line" class="form-select" required>
                                <option value="">Pilih Line</option>
                                @foreach($lines as $line)
                                <option value="{{ $line }}" {{ (request('line') == $line) ? 'selected' : '' }}>
                                    {{ $line }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="model" class="form-label">Model</label>
                            <select name="model" id="model" class="form-select" required>
                                <option value="">Pilih Model</option>
                                @foreach($models as $model)
                                <option value="{{ $model }}" {{ (request('model') == $model) ? 'selected' : '' }}>
                                    {{ $model }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="shift" class="form-label">Shift</label>
                            <select name="shift" id="shift" class="form-select" required>
                                <option value="">Pilih Shift</option>
                                @foreach($shifts as $shift)
                                <option value="{{ $shift }}" {{ (request('shift') == $shift) ? 'selected' : '' }}>
                                    {{ $shift }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}"
                                required>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Tampilkan Checksheet</button>
                        </div>
                    </form>

                    @if($data->isNotEmpty())
                    <form action="{{ route('filter-model.submit') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="checksheet-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Area</th>
                                        <th>Line</th>
                                        <th>Model</th>
                                        <th>Station</th>
                                        <th>Check Item</th>
                                        <th>Standard</th>
                                        <th class="text-center">Actual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $item['area'] }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $item['line'] }}</span>
                                        </td>
                                        <td>
                                            <strong>{{ $item['model'] }}</strong>
                                        </td>

                                        <!-- Input hidden untuk shift dan date supaya tetap terkirim -->
                                        <input type="hidden" name="shift[{{ $item['id_det'] }}]"
                                            value="{{ $item['shift'] }}">
                                        <input type="hidden" name="date[{{ $item['id_det'] }}]"
                                            value="{{ $item['date'] }}">

                                        <td>
                                            <span class="text-muted">{{ $item['station'] }}</span>
                                        </td>
                                        <td>
                                            <div class="fw-medium">{{ $item['check_item'] }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $item['standard'] }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column gap-2">
                                                <select name="actual[{{ $item['id_det'] }}]"
                                                    class="form-select form-select-sm actual-select"
                                                    data-id="{{ $item['id_det'] }}" required>
                                                    <option value="" disabled
                                                        {{ old('actual.' . $item['id_det'], $item['actual']) ? '' : 'selected' }}>
                                                        Choose Action</option>
                                                    <option value="check"
                                                        {{ old('actual.' . $item['id_det'], $item['actual']) == 'check' ? 'selected' : '' }}>
                                                        ✓ Check</option>
                                                    <option value="scan"
                                                        {{ old('actual.' . $item['id_det'], $item['actual']) == 'scan' ? 'selected' : '' }}>
                                                        📱 Scan</option>
                                                </select>

                                                <!-- Area scanner dan hasil scan -->
                                                <div class="barcode-scanner" id="scanner-{{ $item['id_det'] }}"
                                                    style="display:none;">
                                                    <div id="qr-reader-{{ $item['id_det'] }}"
                                                        style="width: 100%; height: 100%;"></div>
                                                    <div class="loading-spinner" id="loading-{{ $item['id_det'] }}">
                                                    </div>

                                                    <div class="mt-2">
                                                        <small class="text-muted">Scan Result:</small>
                                                        <div class="scan-result fw-bold text-success"
                                                            id="result-{{ $item['id_det'] }}">-</div>
                                                        <div class="scan-error text-danger"
                                                            id="error-{{ $item['id_det'] }}"></div>
                                                    </div>

                                                    <div class="scanner-controls mt-2">
                                                        <button type="button" class="btn btn-sm btn-outline-primary"
                                                            id="retry-{{ $item['id_det'] }}">
                                                            🔄 Retry
                                                        </button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger btn-stop-scan"
                                                            data-id="{{ $item['id_det'] }}">⏹️ Stop</button>
                                                    </div>
                                                </div>

                                                <!-- Hidden input hasil scan -->
                                                <input type="hidden" name="trigger[{{ $item['id_det'] }}]"
                                                    id="trigger-{{ $item['id_det'] }}" value="">
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                            <button type="submit" class="btn btn-success btn-lg">
                                Simpan Actual
                            </button>
                        </div>
                    </form>
                    @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle me-2"></i>
                        Tidak ada data checksheet yang ditampilkan.
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @include('layouts/footer-block')

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.2/js/buttons.bootstrap5.min.js"></script>

    <!-- SweetAlert2 for beautiful popups -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- html5-qrcode library -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        $('#checksheet-table').DataTable({
            // Responsive settings
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },

            // Layout and styling
            layout: {
                topStart: {
                    buttons: [{
                            extend: 'copy',
                            text: '📋 Copy',
                            className: 'btn btn-outline-secondary btn-sm'
                        },
                        {
                            extend: 'excel',
                            text: '📊 Excel',
                            className: 'btn btn-outline-success btn-sm'
                        },
                        {
                            extend: 'pdf',
                            text: '📄 PDF',
                            className: 'btn btn-outline-danger btn-sm'
                        }
                    ]
                },
                topEnd: {
                    search: {
                        placeholder: 'Search checksheet...'
                    }
                }
            },

            // Table settings
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: true,
            pageLength: 15,
            lengthMenu: [
                [10, 15, 25, 50, -1],
                [10, 15, 25, 50, "All"]
            ],

            // Responsive column definitions
            columnDefs: [{
                    targets: [0], // # column
                    className: 'text-center',
                    width: '50px',
                    responsivePriority: 1
                },
                {
                    targets: [1, 2], // Area, Line
                    responsivePriority: 2
                },
                {
                    targets: [3], // Model
                    responsivePriority: 1
                },
                {
                    targets: [4, 5, 6], // Station, Check Item, Standard
                    responsivePriority: 3
                },
                {
                    targets: [7], // Actual
                    className: 'text-center',
                    responsivePriority: 1,
                    orderable: false
                }
            ],

            

            // Initialize complete callback
            initComplete: function() {
                // Add custom styling to search input
                $('.dataTables_filter input').addClass('form-control form-control-sm');
                $('.dataTables_length select').addClass('form-select form-select-sm');

                // Add loading state
                this.api().on('processing.dt', function(e, settings, processing) {
                    if (processing) {
                        $('.dataTables_processing').show();
                    } else {
                        $('.dataTables_processing').hide();
                    }
                });
            }
        });

        const scannerInstances = {};

        async function startScanner(id) {
            const scannerContainer = $(`#scanner-${id}`);
            const resultElement = $(`#result-${id}`);
            const errorElement = $(`#error-${id}`);
            const triggerInput = $(`#trigger-${id}`);
            const loadingSpinner = $(`#loading-${id}`);

            resultElement.text('-');
            errorElement.text('');
            triggerInput.val('');
            loadingSpinner.show();
            scannerContainer.show();

            try {
                const cameras = await Html5Qrcode.getCameras();
                if (!cameras || cameras.length === 0) {
                    throw new Error('Kamera tidak ditemukan atau izin ditolak');
                }

                await stopScanner(id);

                const html5QrCode = new Html5Qrcode(`qr-reader-${id}`);
                scannerInstances[id] = html5QrCode;

                await html5QrCode.start({
                        facingMode: "environment"
                    }, {
                        fps: 10,
                        qrbox: {
                            width: 250,
                            height: 250
                        },
                        formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE]
                    },
                    (decodedText) => {
                        resultElement.text(decodedText);
                        triggerInput.val(decodedText);

                        // Set actual select ke 'scan' otomatis kalau belum
                        const selectActual = $(`select.actual-select[data-id="${id}"]`);
                        if (selectActual.val() !== 'scan') {
                            selectActual.val('scan').trigger('change');
                        }

                        Swal.fire({
                            title: 'Scan Berhasil!',
                            html: `Konten QR Code: <strong>${decodedText}</strong>`,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });

                        stopScanner(id);
                    },
                    (errorMessage) => {
                        if (!errorMessage.includes('No MultiFormat Readers')) {
                            errorElement.text('Error: ' + errorMessage);
                        }
                    }
                );

                loadingSpinner.hide();
            } catch (err) {
                loadingSpinner.hide();
                errorElement.text('Error: ' + err.message);
                console.error(`Scanner ${id} error:`, err);

                Swal.fire({
                    title: 'Error!',
                    text: err.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });

                await stopScanner(id);
            }
        }

        async function stopScanner(id) {
            if (scannerInstances[id]) {
                try {
                    await scannerInstances[id].stop();
                    console.log(`Scanner ${id} stopped successfully`);
                } catch (err) {
                    console.error(`Error stopping scanner ${id}:`, err);
                } finally {
                    delete scannerInstances[id];
                    $(`#scanner-${id}`).hide();
                }
            }
        }

        // Event ketika select actual berubah
        $('.actual-select').on('change', function() {
            const id = $(this).data('id');
            if ($(this).val() === 'scan') {
                startScanner(id);
            } else {
                stopScanner(id);
                // Kosongkan hasil scan jika actual bukan scan
                $(`#result-${id}`).text('-');
                $(`#error-${id}`).text('');
                $(`#trigger-${id}`).val('');
            }
        });

        // Tombol stop scan
        $(document).on('click', '.btn-stop-scan', function() {
            const id = $(this).data('id');
            stopScanner(id);
        });

        // Tombol coba lagi (retry)
        $(document).on('click', '[id^="retry-"]', function() {
            const id = this.id.split('-')[1];
            startScanner(id);
        });

        // Submit form, contoh validasi
        $('#form-checksheet').on('submit', function(e) {
            // Bisa tambah validasi khusus disini
            // Contoh validasi minimal satu actual sudah diisi
            let valid = true;
            $('.actual-select').each(function() {
                if (!$(this).val()) {
                    valid = false;
                    return false;
                }
            });

            if (!valid) {
                e.preventDefault();
                Swal.fire({
                    title: 'Peringatan',
                    text: 'Harap isi semua kolom Actual',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    </script>
</body>

</html>