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