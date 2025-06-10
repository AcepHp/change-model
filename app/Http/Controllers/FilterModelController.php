<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogCs;
use App\Models\LogDetailCs;
use Illuminate\Support\Facades\DB;

class FilterModelController extends Controller
{
    public function index(Request $request)
    {
        // Ambil pilihan filter untuk area, line, model dari master CS_ChangeModel
        $areas  = DB::table('CS_ChangeModel')->distinct()->pluck('area');
        $lines  = DB::table('CS_ChangeModel')->distinct()->pluck('line');
        $models = DB::table('CS_ChangeModel')->distinct()->pluck('model');

        // Pilihan shift manual
        $shifts = ['1', '2'];

        // Jika filter belum lengkap, tampilkan form kosong
        if (!$request->filled(['area', 'line', 'model', 'shift', 'date'])) {
            $data = collect();
            return view('filter-model.index', compact('areas', 'lines', 'models', 'shifts', 'data', 'request'));
        }

        // Cek apakah sudah ada log_cs dengan kombinasi area,line,model,shift,date
        $log = LogCs::where('area', $request->area)
            ->where('line', $request->line)
            ->where('model', $request->model)
            ->where('shift', $request->shift)
            ->whereDate('date', $request->date)
            ->first();

        if (!$log) {
            // Belum ada log, buat baru di log_cs
            $log = LogCs::create([
                'area' => $request->area,
                'line' => $request->line,
                'model' => $request->model,
                'shift' => $request->shift,
                'date' => $request->date,
            ]);

            // Ambil data master dari CS_ChangeModel berdasar filter area,line,model
            $masterDetails = DB::table('CS_ChangeModel')
                ->where('area', $request->area)
                ->where('line', $request->line)
                ->where('model', $request->model)
                ->get();

            // Insert ke log_detail_cs dari data master
            foreach ($masterDetails as $master) {
                LogDetailCs::create([
                    'id_log' => $log->id_log,
                    'station' => $master->station,
                    'check_item' => $master->check_item,
                    'standard' => $master->standard,
                    'actual' => null,
                ]);
            }
        }

        // Ambil detail dari log_detail_cs untuk id_log yang ditemukan/baru dibuat
        $details = LogDetailCs::where('id_log', $log->id_log)->get();

        // Gabungkan data untuk tampil
        $data = collect();
        foreach ($details as $detail) {
            $data->push([
                'id_det' => $detail->id_det,
                'area' => $log->area,
                'line' => $log->line,
                'model' => $log->model,
                'shift' => $log->shift,
                'date' => $log->date,
                'station' => $detail->station,
                'check_item' => $detail->check_item,
                'standard' => $detail->standard,
                'actual' => $detail->actual,
            ]);
        }

        return view('filter-model.index', compact('areas', 'lines', 'models', 'shifts', 'data', 'request'));
    }

    public function submit(Request $request)
    {
        // Pastikan actual ada dan berupa array
        if ($request->has('actual') && is_array($request->actual)) {
            foreach ($request->actual as $id_det => $value) {
                LogDetailCs::where('id_det', $id_det)->update(['actual' => $value]);
            }
        }

        return redirect()->route('filter-model.index')->with('success', 'Checksheet berhasil disimpan!');
    }
}
