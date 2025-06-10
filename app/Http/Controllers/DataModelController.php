<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CsChangeModel;

class DataModelController extends Controller
{
    public function index()
    {
        $data = CsChangeModel::all();
        return view('data-model.index', compact('data'));
    }
}
