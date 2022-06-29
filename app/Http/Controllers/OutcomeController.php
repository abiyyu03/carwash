<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outcome;
use DataTables;
use Carbon\Carbon;
use Alert;

class OutcomeController extends Controller
{
    function index()
    {
        $outcome_data = Outcome::get();
        // if(request()->ajax()){
        //     return DataTables::of($outcome_data)
        //         ->editColumn('outcome_date', function(Outcome $outcome){
        //             return $outcome->outcome_date ? with(new Carbon($outcome->outcome_date))->isoFormat('dddd, D MMMM Y')/*->diffForHumans()*/ : '';
        //         })
        //         ->editColumn('outcome_type', function(Outcome $outcome){
        //             return ($outcome->outcomeType->outcome_type == "fix_cost") ? "Fix Cost" : "Variabel Cost";
        //         })
        //         ->editColumn('quantity', function(Outcome $outcome){
        //             return ($outcome->quantity == 1) ? "-" : $outcome->quantity;
        //         })
        //         ->editColumn('action', function(Outcome $outcome){
        //             return '<a href="/outcome/update/'.$outcome->id_outcome.'" class="btn btn-info editButton" id="editButton"><i class="fas fa-pencil-alt"></i> Edit</a>
        //             <a href="/outcome/delete/'.$outcome->id_outcome.'" class="btn btn-danger" id="deleteButton"><i class="fas fa-trash-alt"></i> Hapus</a>';
        //         })
        //         ->rawColumns(['action'])
        //         ->addIndexColumn()
        //         ->toJson();
        // }
        return view('outcome.index',compact('outcome_data'));
    }

    function store(Request $request)
    {
        $outcome_data = new Outcome();
        $outcome_data->needs = $request->needs;
        $outcome_data->quantity = $request->quantity;
        $outcome_data->expense_balance = $request->expense_balance;
        $outcome_data->outcome_date = date('Y-m-d');
        $outcome_data->outcome_type_id =$request->outcome_type_id;
        $outcome_data->save();

        Alert::success('Sukses','Pengeluaran berhasil diatur !');
        return back();
    }
    
    function delete($id_outcome){
        $outcome_data = Outcome::find($id_outcome);
        $outcome_data->delete();

        Alert::success('Sukses','Pengeluaran berhasil dihapus !');
        return back();
    }
    
    function update(Request $request, $id_outcome){
        $outcome_data = Outcome::find($id_outcome);
        $outcome_data->needs = $request->needs;
        $outcome_data->quantity = $request->quantity;
        $outcome_data->expense_balance = $request->expense_balance;
        $outcome_data->save();

        Alert::success('Sukses','Pengeluaran berhasil diubah !');
        return back();
    }
}
