<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Dashboard'])
    @include('layouts.head-css')

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


</head>

<body>
    @include('layouts.layout-vertical')
    @include('layouts.loading')
    <div class="pc-container">
        <div class="pc-content">
            @include('layouts.breadcrumb', [
            'breadcrumbs' => [
            ['label' => 'Home', 'url' => '/dashboard', 'active' => false],
            ['label' => 'Dashboard', 'url' => '/dashboard', 'active' => true],
            ]
            ])

            <div class="stats-grid">
                <div class="stat-card" style="--card-color: #3b82f6;">
                    <div class="stat-icon">
                        <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="stat-label">Total Checksheet Hari Ini</div>
                    <h3 class="stat-value">{{ number_format($checksheetToday) }}</h3>
                </div>

                <div class="stat-card" style="--card-color: #10b981;">
                    <div class="stat-icon">
                        <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        </svg>
                    </div>
                    <div class="stat-label">Shift 1</div>
                    <h3 class="stat-value">{{ number_format($checksheetShift1) }}</h3>
                </div>

                <div class="stat-card" style="--card-color: #f59e0b;">
                    <div class="stat-icon">
                        <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </div>
                    <div class="stat-label">Shift 2</div>
                    <h3 class="stat-value">{{ number_format($checksheetShift2) }}</h3>
                </div>

                <div class="stat-card" style="--card-color: #8b5cf6;">
                    <div class="stat-icon">
                        <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547A8.014 8.014 0 004 21h16a8.014 8.014 0 00-.244-5.572zM12 2a5 5 0 11-5 5 5 5 0 015-5z" />
                        </svg>
                    </div>
                    <div class="stat-label">Total Master Change Model</div>
                    <h3 class="stat-value">{{ number_format($totalCSChangeModel) }}</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="table-container mb-4">
                        <div class="equal-header">
                            <h5>Data Checksheet Hari Ini</h5>
                            <form method="GET" class="filter-section">
                                <label for="shift">Filter:</label>
                                <select name="shift" id="shift" onchange="this.form.submit()">
                                    <option value="">Semua Shift</option>
                                    <option value="1" {{ request('shift') == '1' ? 'selected' : '' }}>Shift 1</option>
                                    <option value="2" {{ request('shift') == '2' ? 'selected' : '' }}>Shift 2</option>
                                </select>
                            </form>
                        </div>
                        <div class="table-responsive px-2 pb-2">
                            <table id="log-detail-table" class="simple-table display">
                                <thead>
                                    <tr>
                                        <th style="width: 10px;">#</th>
                                        <th>Tanggal</th>
                                        <th>Shift</th>
                                        <th>Station</th>
                                        <th style="width: 200px;">Check Item</th>
                                        <th style="width: 250px;">Standard</th>
                                        <th style="width: 50px;">Actual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logDetailTableData as $i => $row)
                                    <tr>
                                        <td class="row-number" style="width: 10px;">{{ $i + 1 }}</td>
                                        <td>{{ $row->log->date ?? '-' }}</td>
                                        <td>
                                            <span class="shift-badge">Shift {{ $row->log->shift ?? '-' }}</span>
                                        </td>
                                        <td>{{ $row->station }}</td>
                                        <td style="width: 200px;">{{ $row->check_item }}</td>
                                        <td style="width: 250px;">{{ $row->standard }}</td>
                                        <td style="width: 50px;">
                                            @if($row->actual === 'OK')
                                            <span class="status-ok">OK</span>
                                            @elseif($row->actual === 'NG')
                                            <span class="status-ng">NG</span>
                                            @else
                                            {{ $row->actual }}
                                            @endif
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse
                                </tbody>


                            </table>
                        </div>


                    </div>
                </div>

                <div class="col-lg-4 col-md-5">
                    <div class="chart-container mb-4">
                        <div class="equal-header">
                            <div class="chart-header-content">
                                <h6>Perbandingan Status</h6>
                                <div class="chart-subtitle">
                                    @if(request('shift'))
                                    Data Shift {{ request('shift') }} Hari Ini
                                    @else
                                    Semua Data Hari Ini
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="chart-body">
                            <canvas id="okNgPieChart" width="200" height="240"></canvas>
                        </div>
                        <div class="chart-stats">
                            <div class="chart-stat-item">
                                <div class="chart-stat-value ok-stat">{{ $okCount }}</div>
                                <div class="chart-stat-label">OK</div>
                            </div>
                            <div class="chart-stat-item">
                                <div class="chart-stat-value ng-stat">{{ $ngCount }}</div>
                                <div class="chart-stat-label">NG</div>
                            </div>
                            <div class="chart-stat-item">
                                <div class="chart-stat-value total-stat">{{ $okCount + $ngCount }}</div>
                                <div class="chart-stat-label">Total</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-container mb-4">
                            <div class="equal-header">
                                <h5>Data Cheeksheet Total</h5>
                                <form method="GET" class="filter-section d-flex flex-wrap gap-2 align-items-center">
                                    <label>Filter:</label>

                                    <select id="area-filter">
                                        <option value="">Semua Area</option>
                                        @foreach($areas as $area)
                                        <option value="{{ $area }}">{{ $area }}</option>
                                        @endforeach
                                    </select>

                                    <select id="line-filter">
                                        <option value="">Semua Line</option>
                                        @foreach($lines as $line)
                                        <option value="{{ $line }}">{{ $line }}</option>
                                        @endforeach
                                    </select>

                                    <select id="model-filter">
                                        <option value="">Semua Model</option>
                                        @foreach($models as $model)
                                        <option value="{{ $model }}">{{ $model }}</option>
                                        @endforeach
                                    </select>

                                    <select id="shift-filter">
                                        <option value="">Semua Shift</option>
                                        <option value="1">Shift 1</option>
                                        <option value="2">Shift 2</option>
                                    </select>

                                    <input type="date" id="date-filter"
                                        value="{{ request('date') ?? \Carbon\Carbon::today()->format('Y-m-d') }}"
                                        class=" custom-date-input">

                                </form>
                            </div>

                            <div class="table-responsive px-2 pb-2">
                                <div id="table-container">
                                    @include('dashboard.partials.log_detail_table', ['logDetailTableData' => collect()])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer-block')

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('okNgPieChart').getContext('2d');

        const okCount = @json($okCount);
        const ngCount = @json($ngCount);
        const total = okCount + ngCount;

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['OK', 'NG'],
                datasets: [{
                    label: 'Status',
                    data: [okCount, ngCount],
                    backgroundColor: [
                        '#10b981',
                        '#ef4444'
                    ],
                    borderColor: [
                        '#ffffff',
                        '#ffffff'
                    ],
                    borderWidth: 3,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            usePointStyle: true,
                            pointStyle: 'circle',
                            color: '#374151'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed;
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) :
                                    0;
                                return `${context.label}: ${value} (${percentage}%)`;
                            }
                        },
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        cornerRadius: 6,
                        padding: 10
                    }
                },
                cutout: '65%',
                animation: {
                    animateRotate: true,
                    duration: 800
                }
            }
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#log-detail-table').DataTable({
            paging: true,
            pageLength: 8,
            lengthChange: false,
            searching: false,
            ordering: false,
            info: false,
            responsive: true,
            language: {
                paginate: {
                    previous: "‹",
                    next: "›"
                },
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                zeroRecords: "Tidak ada data ditemukan",
                search: "Cari:",
                emptyTable: "Tidak ada data checksheet hari ini"
            }
        });
    });
    </script>
    @push('scripts')
    <script>
    function loadFilteredData() {
        let area = $('#area-filter').val();
        let line = $('#line-filter').val();
        let model = $('#model-filter').val();
        let shift = $('#shift-filter').val();
        let date = $('#date-filter').val();

        $.ajax({
            url: "{{ route('dashboard.filter') }}",
            type: 'GET',
            data: {
                area,
                line,
                model,
                shift,
                date
            },
            success: function(response) {
                // Destroy DataTables sebelum replace table
                if ($.fn.DataTable.isDataTable('#change-model-table')) {
                    $('#change-model-table').DataTable().destroy();
                }

                // Ganti isi table-container dengan hasil response (table baru)
                $('#table-container').html(response);

                // Inisialisasi ulang DataTables
                $('#change-model-table').DataTable({
                    paging: true,
                    pageLength: 8,
                    lengthChange: false,
                    searching: false,
                    ordering: false,
                    info: false,
                    responsive: true,
                    language: {
                        paginate: {
                            previous: "‹",
                            next: "›"
                        },
                        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        zeroRecords: "Tidak ada data ditemukan",
                        search: "Cari:",
                        emptyTable: "Tidak ada data checksheet hari ini"
                    }
                });
            },
            error: function() {
                alert('Gagal memuat data.');
            }
        });
    }

    // Event listener untuk semua filter
    $('#area-filter, #line-filter, #model-filter, #shift-filter, #date-filter').on('change', function() {
        loadFilteredData();
    });

    // Load data awal saat halaman pertama kali dibuka
    $(document).ready(function() {
        loadFilteredData();
    });
    </script>


</body>

</html>