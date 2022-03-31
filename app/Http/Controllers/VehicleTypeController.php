<?php

namespace App\Http\Controllers;

use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    public function index()
    {
        return view('vehicle_type.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $vehicleType_data = new VehicleType();
        $vehicleType_data->vehicle_type = $request->get('vehicle_type');
        $vehicleType_data->save();
        return redirect()->back();
    }

    public function show(VehicleType $vehicleType)
    {
        //
    }

    public function edit(VehicleType $vehicleType)
    {
        //
    }

    public function update(Request $request, VehicleType $vehicleType)
    {
        //
    }

    public function destroy(VehicleType $vehicleType)
    {
        //
    }
}
