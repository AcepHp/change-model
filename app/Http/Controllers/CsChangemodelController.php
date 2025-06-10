<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsChangeModel;
use App\Models\LogCs;
use App\Models\LogDetailCs;
use Illuminate\Support\Facades\DB;

class CsChangeModelController extends Controller
{
    public function index()
    {
        $areas = CsChangeModel::select('area')->distinct()->pluck('area');
        $lines = CsChangeModel::select('line')->distinct()->pluck('line');
        $models = CsChangeModel::select('model')->distinct()->pluck('model');

        return view('cs.filter', compact('areas', 'lines', 'models'));
    }

    public function show(Request $request)
    {
        $data = CsChangeModel::query()
            ->when($request->area, fn($q) => $q->where('area', $request->area))
            ->when($request->line, fn($q) => $q->where('line', $request->line))
            ->when($request->model, fn($q) => $q->where('model', $request->model))
            ->orderBy('list')
            ->get();

        // Simpan nilai shift dan date untuk keperluan submit selanjutnya
        $shift = $request->shift;
        $date = $request->date;

        return view('cs.result', compact('data', 'shift', 'date'));
    }

    public function submit(Request $request)
    {
        DB::beginTransaction();
        try {
            // Simpan ke log_cs
            $log = new LogCs();
            $log->area = $request->area;
            $log->line = $request->line;
            $log->model = $request->model;
            $log->shift = $request->shift;
            $log->date = $request->date;
            $log->save();

            // Simpan ke log_detail_cs
            foreach ($request->data as $item) {
                $detail = new LogDetailCs();
                $detail->id_log = $log->id_log;
                $detail->station = $item['station'];
                $detail->check_item = $item['check_item'];
                $detail->standard = $item['standard'];
                $detail->actual = $item['actual'];
                $detail->save();
            }

            DB::commit();
            return redirect()->route('cs.index')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

}