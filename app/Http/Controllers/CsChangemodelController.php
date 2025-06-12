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
        $shift = $request->shift;
        $date = $request->date;
        return view('cs.result', compact('data', 'shift', 'date'));
    }

    public function submit(Request $request)
    {
        $data  = $request->input('data');
        $shift = $request->input('shift');
        $date  = $request->input('date');
        $area  = $request->input('area');
        $line  = $request->input('line');
        $model = $request->input('model');
        $logId = DB::table('log_cs')->insertGetId([
            'area'  => $area,
            'line'  => $line,
            'model' => $model,
            'shift' => $shift,
            'date'  => $date,
        ]);
        foreach ($data as $id => $item) {
            if (!isset($item['station'], $item['check_item'], $item['standard'], $item['actual'])) {
                continue;
            }
            $actualValue = '';
            if ($item['actual'] === 'check') {
                $actualValue = $item['action'];
            } elseif ($item['actual'] === 'scan') {
                $scanResult = $item['action'];
                $trigger    = $item['trigger'];
                $actualValue = ($scanResult === $trigger) ? 'OK' : 'NG';
            } else {
                continue;
            }
            DB::table('log_detail_cs')->insert([
                'id_log'     => $logId,
                'station'    => $item['station'],
                'check_item' => $item['check_item'],
                'standard'   => $item['standard'],
                'actual'     => $actualValue,
            ]);
        }
        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}