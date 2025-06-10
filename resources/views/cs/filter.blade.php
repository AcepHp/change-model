<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Filter Data'])
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
            ['label' => 'Data CS Change Model', 'url' => '/data-model', 'active' => true],
            ]
            ])

            <div class="card p-4">
                <form action="{{ route('cs.show') }}" method="GET">
                    <div class="row gx-2 gy-2">
                        <div class="col-md">
                            <label for="area" class="form-label">Area</label>
                            <select name="area" id="area" class="form-select">
                                <option value="" disabled selected>-- Pilih Area --</option>
                                @foreach($areas as $area)
                                <option value="{{ $area }}">{{ $area }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md">
                            <label for="line" class="form-label">Line</label>
                            <select name="line" id="line" class="form-select">
                                <option value="" disabled selected>-- Pilih Line --</option>
                                @foreach($lines as $line)
                                <option value="{{ $line }}">{{ $line }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md">
                            <label for="model" class="form-label">Model</label>
                            <select name="model" id="model" class="form-select">
                                <option value="" disabled selected>-- Pilih Model --</option>
                                @foreach($models as $model)
                                <option value="{{ $model }}">{{ $model }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md">
                            <label for="shift" class="form-label">Shift</label>
                            <select name="shift" id="shift" class="form-select">
                                <option value="" disabled selected>-- Pilih Shift --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>


                        <div class="col-md">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                    </div>

                    {{-- Tombol di baris terpisah --}}
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Tampilkan Checksheet</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @include('layouts.footer-block')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

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

    <!-- Bootstrap, Feather, Popper, Chart -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace();
    </script>
</body>

</html>