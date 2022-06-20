<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outcome;
use DataTables;
use Alert;

class OutcomeController extends Controller
{
    function index()
    {
        $outcome_data = Outcome::get();
        if(request()->ajax()){
            return DataTables::of($outcome_data)
                ->addIndexColumn()
                ->make(true);
        }
        return view('outcome.index');
    }

    function store(Request $request)
    {
        $outcome_data = new Outcome();
        $outcome_data->needs = $request->needs;
        $outcome_data->quantity = $request->quantity;
        $outcome_data->expanse_balance = $request->expanse_balance;
        $outcome_data->save();

        Alert::success('Sukses','Pengeluaran berhasil diatur !');
        return back();
    }
}
