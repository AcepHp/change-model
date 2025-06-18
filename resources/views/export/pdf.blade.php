<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Log CS Report</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 30px;
        color: #333;
        line-height: 1.5;
    }

    .header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 15px;
        border-bottom: 2px solid #333;
    }

    .header h2 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin: 0;
    }

    .log-section {
        margin-bottom: 40px;
        page-break-inside: avoid;
    }

    .log-info {
        background: #f9f9f9;
        padding: 15px;
        margin-bottom: 20px;
        border-left: 4px solid #333;
    }

    .info-row {
        display: flex;
        margin-bottom: 8px;
    }

    .info-label {
        font-weight: bold;
        width: 100px;
        color: #333;
    }

    .info-value {
        color: #666;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th {
        background: #333;
        color: white;
        padding: 12px 8px;
        text-align: left;
        font-weight: bold;
        font-size: 11px;
    }

    td {
        padding: 10px 8px;
        border-bottom: 1px solid #ddd;
        font-size: 11px;
    }

    tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .divider {
        margin: 30px 0;
        border: none;
        border-top: 1px solid #ddd;
    }

    .no-data {
        text-align: center;
        padding: 40px;
        color: #666;
        font-style: italic;
        border: 1px solid #ddd;
        background: #f9f9f9;
    }

    @media print {
        body {
            margin: 20px;
        }

        th {
            background: #333 !important;
            color: white !important;
            -webkit-print-color-adjust: exact;
        }
    }
    </style>
</head>

<body>
    @forelse($data as $log)
    <div class="log-section">
        <div class="log-info">
            <table style="width: 100%; font-size: 12px;">
                <tr>
                    <td style="font-weight: bold; width: 40px;">Area</td>
                    <td style="width: 5px; ">:</td>
                    <td>{{ $log->area }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Line</td>
                    <td>:</td>
                    <td>{{ $log->line }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Model</td>
                    <td>:</td>
                    <td>{{ $log->model }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Shift</td>
                    <td>:</td>
                    <td>{{ $log->shift }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Date</td>
                    <td>:</td>
                    <td>{{ \Carbon\Carbon::parse($log->date)->format('d-m-Y') }}</td>
                </tr>
            </table>
        </div>

        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr>
                    <th style="width: 10px; text-align: center;">No</th>
                    <th style="text-align: center;">Station</th>
                    <th style="text-align: center;">Check Item</th>
                    <th style="text-align: center;">Standard</th>
                    <th style="width: 50px; text-align: center;">Actual</th>
                </tr>
            </thead>
            <tbody>
                @foreach($log->details as $index => $detail)
                <tr>
                    <td style="width: 10px; text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ $detail->station }}</td>
                    <td style="text-align: center;">{{ $detail->check_item }}</td>
                    <td style="text-align: center;">{{ $detail->standard }}</td>
                    <td style="width: 50px; text-align: center;">{{ $detail->actual }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    @if (!$loop->last)
        <br>
    @endif
    @empty
    <div class="no-data">
        Tidak ada data tersedia untuk filter yang dipilih.
    </div>
    @endforelse

</body>

</html>