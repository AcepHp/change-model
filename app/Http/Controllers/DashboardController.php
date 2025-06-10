<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LogCS;
use App\Models\LogDetailCS;
use App\Models\CSChangeModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalLogCS = LogCS::count();
        $totalLogDetailCS = LogDetailCS::count();
        $totalCSChangeModel = CSChangeModel::count();

        // Data per tanggal (date)
        $logcsByDate = LogCS::select('date', DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Data per minggu (week) - SQL Server
        $logcsByWeek = LogCS::select(
                DB::raw('DATEPART(ISO_WEEK, date) as week'),
                DB::raw('DATEPART(YEAR, date) as year'),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw('DATEPART(YEAR, date)'), DB::raw('DATEPART(ISO_WEEK, date)'))
            ->orderBy(DB::raw('DATEPART(YEAR, date)'))
            ->orderBy(DB::raw('DATEPART(ISO_WEEK, date)'))
            ->get();

        // Data per bulan (month)
        $logcsByMonth = LogCS::select(
                DB::raw("FORMAT(date, 'yyyy-MM') as month"),
                DB::raw('count(*) as total')
            )
            ->groupBy(DB::raw("FORMAT(date, 'yyyy-MM')"))
            ->orderBy(DB::raw("FORMAT(date, 'yyyy-MM')"))
            ->get();

        // Data Log CS per hari dalam minggu ini untuk chart batang
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $logsThisWeek = LogCS::select(
                DB::raw("DATENAME(WEEKDAY, date) as day"),
                DB::raw('count(*) as total')
            )
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->groupBy(DB::raw("DATENAME(WEEKDAY, date)"))
            ->get();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        $dataByDay = collect($daysOfWeek)->map(function($day) use ($logsThisWeek) {
            $log = $logsThisWeek->firstWhere('day', $day);
            return $log ? $log->total : 0;
        });

        $totalLogsWeek = $logsThisWeek->sum('total');

        return view('dashboard.index', compact(
            'totalUsers',
            'totalLogCS',
            'totalLogDetailCS',
            'totalCSChangeModel',
            'logcsByDate',
            'logcsByWeek',
            'logcsByMonth',
            'daysOfWeek',
            'dataByDay',
            'totalLogsWeek'
        ));
    }
}
