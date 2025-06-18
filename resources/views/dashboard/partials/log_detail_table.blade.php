<table id="change-model-table" class="simple-table display">
    <thead>
        <tr>
            <th style="width: 10px;">#</th>
            <th>Tanggal</th>
            <th>Shift</th>
            <th>Area</th>
            <th>Line</th>
            <th>Model</th>
            <th>Station</th>
            <th style="width: 200px;">Check Item</th>
            <th style="width: 250px;">Standard</th>
            <th style="width: 50px;">Actual</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($logDetailTableData as $i => $item)
        <tr>
            <td class="row-number">{{ $i + 1 }}</td>
            <td>{{ $item->log->date ?? '-' }}</td>
            <td>
                <span class="shift-badge">Shift {{ $item->log->shift ?? '-' }}</span>
            </td>
            <td>{{ $item->log->area ?? '-' }}</td>
            <td>{{ $item->log->line ?? '-' }}</td>
            <td>{{ $item->log->model ?? '-' }}</td>
            <td>{{ $item->station }}</td>
            <td style="width: 200px;">{{ $item->check_item }}</td>
            <td style="width: 250px;">{{ $item->standard }}</td>
            <td style="width: 50px;">
                @if($item->actual === 'OK')
                    <span class="status-ok">OK</span>
                @elseif($item->actual === 'NG')
                    <span class="status-ng">NG</span>
                @else
                    {{ $item->actual }}
                @endif
            </td>
        </tr>
        @empty
        
        @endforelse
    </tbody>
</table>
