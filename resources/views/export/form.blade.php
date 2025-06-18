<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head-page-meta', ['title' => 'Filter Export Log CS'])
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
            ['label' => 'Export Log CS', 'url' => '#', 'active' => true],
            ]
            ])

            <div class="card p-4">
                <form action="{{ route('export.pdf') }}" method="POST">
                    @csrf
                    <div class="row gx-2 gy-2">

                        <div class="col-md">
                            <label for="model" class="form-label">Model</label>
                            <select name="model" id="model" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Model --</option>
                                @foreach($models as $model)
                                <option value="{{ $model }}">{{ $model }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md">
                            <label for="shift" class="form-label">Shift</label>
                            <select name="shift" id="shift" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Shift --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>

                        <div class="col-md">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="date" name="date" id="date" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" id="btn-export" class="btn btn-primary">Export ke PDF</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @include('layouts.footer-block')

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <script>
    feather.replace();

    $('#btn-export').click(function(e) {
        e.preventDefault();
        showLoading();

        let formData = {
            model: $('#model').val(),
            shift: $('#shift').val(),
            date: $('#date').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: "{{ route('export.pdf') }}",
            type: 'POST',
            data: formData,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data, status, xhr) {
                hideLoading();

                const filename = xhr.getResponseHeader('Content-Disposition')
                    ?.split('filename=')[1]
                    ?.replace(/['"]/g, '') || 'export.pdf';

                const blob = new Blob([data], {
                    type: 'application/pdf'
                });
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                link.click();
            },
            error: function(xhr) {
                hideLoading();
                alert('Gagal export. Silakan coba lagi.');
            }
        });
    });
    </script>

</body>

</html>