<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogDetailCS;
use App\Models\CSChangeModel;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today();
        $shift = $request->get('shift');

        // Query utama, ambil semua data (untuk DataTables)
        $logDetailTableData = LogDetailCS::with('log')
            ->whereHas('log', function ($query) use ($today, $shift) {
                $query->whereDate('date', $today);
                if (!is_null($shift)) {
                    $query->where('shift', $shift);
                }
            })
            ->get();

        // Summary data
        $checksheetToday = LogDetailCS::whereHas('log', fn($q) => $q->whereDate('date', $today))->count();
        $checksheetShift1 = LogDetailCS::whereHas('log', fn($q) => $q->whereDate('date', $today)->where('shift', 1))->count();
        $checksheetShift2 = LogDetailCS::whereHas('log', fn($q) => $q->whereDate('date', $today)->where('shift', 2))->count();
        $totalCSChangeModel = CSChangeModel::count();

        // OK / NG count
        $okCount = $logDetailTableData->where('actual', 'OK')->count();
        $ngCount = $logDetailTableData->where('actual', 'NG')->count();
        
        // Ambil data filter options
        $areas  = \DB::table('log_cs')->select('area')->distinct()->pluck('area');
        $lines  = \DB::table('log_cs')->select('line')->distinct()->pluck('line');
        $models = CSChangeModel::select('model')->distinct()->pluck('model');

        return view('dashboard.index', compact(
            'checksheetToday', 'checksheetShift1', 'checksheetShift2',
            'totalCSChangeModel', 'logDetailTableData', 'shift',
            'okCount', 'ngCount', 'areas', 'lines', 'models'
        ));
    }
    

    public function filterData(Request $request)
    {
        $date  = $request->get('date') ?? Carbon::today()->format('Y-m-d');
        $shift = $request->get('shift');
        $area  = $request->get('area');
        $line  = $request->get('line');
        $model = $request->get('model');

        $logDetailTableData = LogDetailCS::with('log')
            ->whereHas('log', function ($query) use ($date, $shift, $area, $line, $model) {
                $query->whereDate('date', $date);
                if ($shift) $query->where('shift', $shift);
                if ($area)  $query->where('area', $area);
                if ($line)  $query->where('line', $line);
                if ($model) $query->where('model', $model);
            })
            ->get();

        return view('dashboard.partials.log_detail_table', compact('logDetailTableData'))->render();
    }
}
