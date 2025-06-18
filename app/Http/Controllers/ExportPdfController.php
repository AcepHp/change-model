<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogCs;
use PDF;

class ExportPdfController extends Controller
{
    public function form()
    {
        $models = LogCs::select('model')->distinct()->pluck('model');

        return view('export.form', compact('models'));
    }

    public function export(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'shift' => 'required|string',
            'model' => 'required|string',
        ]);

        $data = LogCs::with('details')
            ->where('date', $request->date)
            ->where('shift', $request->shift)
            ->where('model', $request->model)
            ->get();

        $pdf = PDF::loadView('export.pdf', compact('data'));
        return $pdf->download('log-cs-' . now()->format('Ymd_His') . '.pdf');
    }
}
