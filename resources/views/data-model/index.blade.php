<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Data CS Change Model'])
    @include('layouts.head-css')

    <!-- DataTables CSS (versi terbaru + responsive) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <style>
    /* Optional: Styling tambahan biar tabel lebih clean */
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
            ['label' => 'Data CS Change Model', 'url' => '/data-model', 'active' => true],
            ]
            ])

            <div class="card">
                <div class="card-header">
                    <h5>Data CS Change Model</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-data-cs" class="table table-striped table-hover  table-xl" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Area</th>
                                    <th>Line</th>
                                    <th>Model</th>
                                    <th>List</th>
                                    <th>Station</th>
                                    <th>Check Item</th>
                                    <th>Standard</th>
                                    <th>Actual</th>
                                    <th>Trigger</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->area }}</td>
                                    <td>{{ $item->line }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->list }}</td>
                                    <td>{{ $item->station }}</td>
                                    <td>{{ $item->check_item }}</td>
                                    <td>{{ $item->standard }}</td>
                                    <td>{{ $item->actual }}</td>
                                    <td>{{ $item->trigger }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('layouts/footer-block')

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS + Responsive plugin -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <!-- DataTables Initialization -->
    <script>
    $(document).ready(function() {
        $('#table-data-cs').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: true,
            pageLength: 10,
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
    });
    </script>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- Bootstrap, Popper, Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace();
    </script>

</body>

</html>