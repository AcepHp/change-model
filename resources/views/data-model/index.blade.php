<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Data CS Change Model'])
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
    </style>
</head>

<body>
    @include('layouts.layout-vertical')
    @include('layouts.loading')
    <div class="pc-container">
        <div class="pc-content">
            @include('layouts.breadcrumb', [
            'breadcrumbs' => [
            ['label' => 'Home', 'url' => '/dashboard', 'active' => false],
            ['label' => 'Data CS Change Model', 'url' => '/data-model', 'active' => true],
            ]
            ])

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-data-cs" class="table table-striped table-hover  table-xl" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="max-width: 20px;">#</th>
                                    <th style="max-width: 35px;">Area</th>
                                    <th style="max-width: 30px;">Line</th>
                                    <th>Model</th>
                                    <th style="max-width: 30px;">List</th>
                                    <th style="max-width: 50px;">Station</th>
                                    <th>Check Item</th>
                                    <th>Standard</th>
                                    <th style="max-width: 45px;">Actual</th>
                                    <th style="max-width: 50px;">Trigger</th>
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
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
                    next: ">",
                    previous: "<"
                }
            }
        });
    });
    </script>


    <script>
    feather.replace();
    </script>

</body>

</html>