<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @include('layouts.head-page-meta', ['title' => 'Hasil Filter'])
    @include('layouts.head-css')
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

    #qr-reader {
        min-height: 300px;
    }

    .camera-error {
        color: #dc3545;
        padding: 10px;
        border: 1px solid #dc3545;
        border-radius: 4px;
        margin-bottom: 10px;
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
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

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
                                    <th style="max-width: 30px;">List</th>
                                    <th style="max-width: 50px">Station</th>
                                    <th>Check Item</th>
                                    <th>Standard</th>
                                    <th style="max-width: 60px">Actual</th>
                                    <th style="max-width: 60px">Trigger</th>
                                    <th style="max-width: 90px">Action</th>
                                    <th style="max-width: 80px">Scan Result</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item->list }}</td>
                                    <td>{{ $item->station }}</td>
                                    <td>{{ $item->check_item }}</td>
                                    <td>{{ $item->standard }}</td>
                                    <td>{{ $item->actual }}</td>
                                    <td>{{ $item->trigger }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        @if(isset($item->actual) && $item->actual == 'check')
                                        <input type="hidden" name="data[{{ $item->id }}][station]"
                                            value="{{ $item->station }}">
                                        <input type="hidden" name="data[{{ $item->id }}][check_item]"
                                            value="{{ $item->check_item }}">
                                        <input type="hidden" name="data[{{ $item->id }}][standard]"
                                            value="{{ $item->standard }}">
                                        <input type="hidden" name="data[{{ $item->id }}][actual]" value="check">
                                        <select name="data[{{ $item->id }}][action]" class="form-select actual-select"
                                            required>
                                            <option value="">-- Pilih --</option>
                                            <option value="OK">OK</option>
                                            <option value="NG">NG</option>
                                        </select>
                                        @elseif(isset($item->actual) && $item->actual == 'scan')
                                        <input type="hidden" name="data[{{ $item->id }}][station]"
                                            value="{{ $item->station }}">
                                        <input type="hidden" name="data[{{ $item->id }}][check_item]"
                                            value="{{ $item->check_item }}">
                                        <input type="hidden" name="data[{{ $item->id }}][standard]"
                                            value="{{ $item->standard }}">
                                        <input type="hidden" name="data[{{ $item->id }}][actual]" value="scan">
                                        <button type="button" class="btn btn-primary btn-sm btn-scan"
                                            data-id="{{ $item->id }}">Scan</button>
                                        <input type="hidden" name="data[{{ $item->id }}][trigger]"
                                            value="{{ $item->trigger }}">
                                        <input type="hidden" name="data[{{ $item->id }}][action]"
                                            class="scan-result-hidden" id="scan-result-{{ $item->id }}">
                                        @else
                                        <span>-</span>
                                        @endif
                                    </td>
                                    <td class="scan-result-cell" data-id="{{ $item->id }}">-</td>
                                </tr>
                                @empty
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

    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Scan QR/Barcode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="camera-error" class="camera-error" style="display: none;"></div>
                    <div id="qr-reader"></div>
                    <div class="mt-2">
                        <button type="button" id="swapCameraBtn" class="btn btn-secondary btn-sm">Switch Camera</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>

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
                    responsivePriority: 0,
                    targets: 0
                },
                {
                    responsivePriority: 6,
                    targets: 6
                },
                {
                    responsivePriority: 7,
                    targets: 7
                }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari data...",
                lengthMenu: "Tampilkan _MENU_ data",
                emptyTable: "Tidak ada data ditemukan",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: ">",
                    previous: "<"
                }
            }
        });

        function checkActualFields() {
            let allFilled = true;
            $('.actual-select').each(function() {
                if (!$(this).val()) {
                    allFilled = false;
                    return false;
                }
            });
            return allFilled;
        }

        $('.actual-select').on('change', function() {
            $('button[type="submit"]').prop('disabled', !checkActualFields());
        });

        $('button[type="submit"]').prop('disabled', true);

        $('form').on('submit', function(e) {
            if (!checkActualFields()) {
                e.preventDefault();
                alert('Semua kolom Actual wajib diisi sebelum submit!');
            }
        });
    });

    let html5QrCode;
    let currentFacingMode = "environment";
    let scanTargetCell = null;
    let scanHiddenInput = null;

    $(document).on('click', '.btn-scan', function() {
        let id = $(this).data('id');
        scanTargetCell = $('.scan-result-cell[data-id="' + id + '"]');
        scanHiddenInput = $('#scan-result-' + id);
        startScanner();
    });

    function startScanner() {
        $('#scanModal').modal('show');
        $('#camera-error').hide();
        $('#qr-reader').show();
        $('#manual-input').hide();
        $('#manual-scan-input').val('');

        if (html5QrCode && html5QrCode.isScanning) {
            html5QrCode.stop();
        }

        html5QrCode = new Html5Qrcode("qr-reader");

        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            showCameraError("Browser doesn't support camera access");
            return;
        }

        html5QrCode.start({
                facingMode: currentFacingMode
            }, {
                fps: 10,
                qrbox: 250,
                aspectRatio: 1.0
            },
            (decodedText) => {
                if (scanTargetCell && scanHiddenInput) {
                    scanTargetCell.text(decodedText);
                    scanHiddenInput.val(decodedText);
                    stopScanner();
                }
            },
            (errorMessage) => {
                console.log("Scan error:", errorMessage);
            }
        ).catch(err => {
            console.error("Camera error:", err);
            showCameraError(err.message || "Failed to access camera");
        });
    }

    function showCameraError(message) {
        let errorText = "Cannot access camera. Please:";
        errorText += "<br>1. Grant camera permissions";
        errorText += "<br>2. Use HTTPS (in production)";
        errorText += "<br>3. Try a different browser";

        if (message.includes('denied') || message.includes('permission')) {
            errorText = "Camera access was denied. Please enable camera permissions in your browser settings.";
        }

        $('#camera-error').html(errorText).show();
        $('#qr-reader').hide();
        $('#manual-input').show();
    }

    function stopScanner() {
        if (html5QrCode) {
            html5QrCode.stop()
                .then(() => {
                    html5QrCode.clear();
                    $('#scanModal').modal('hide');
                })
                .catch((err) => {
                    console.log("Stop failed:", err);
                    $('#scanModal').modal('hide');
                });
        } else {
            $('#scanModal').modal('hide');
        }
    }


    $('#swapCameraBtn').on('click', function() {
        currentFacingMode = currentFacingMode === "environment" ? "user" : "environment";
        startScanner();
    });

    $('#toggle-input').click(function() {
        $('#qr-reader').toggle();
        $('#manual-input').toggle();
    });

    $('#confirm-manual-input').click(function() {
        const manualValue = $('#manual-scan-input').val().trim();
        if (manualValue) {
            if (scanTargetCell && scanHiddenInput) {
                scanTargetCell.text(manualValue);
                scanHiddenInput.val(manualValue);
            }
            stopScanner();
        } else {
            alert('Please enter a valid code');
        }
    });

    $('#scanModal').on('hidden.bs.modal', function() {
        stopScanner();
    });

    feather.replace();
    </script>
</body>

</html>