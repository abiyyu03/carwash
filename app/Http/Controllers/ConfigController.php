<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\{User, Config};

class ConfigController extends Controller
{
    function index()
    {
        $config_data = Config::find(1);
        return view('config.index',compact('config_data'));
    }

    function update(Request $request, $id_user)
    {
        $user_data = User::find($id_user);
        $user_data->name = $request->name;
        $user_data->save();

        Alert::success('Sukses','Profil mu berhasil diubah !');
        return back();
    }
    function updateConfig(Request $request, $id_config)
    {
        $config_data = Config::find($id_config);
        $config_data->carwash_name = $request->carwash_name;
        $config_data->carwash_address = $request->carwash_address;
        $config_data->commission_percentage = $request->commission_percentage;
        $config_data->save();

        Alert::success('Sukses','Profil Carwash berhasil diubah !');
        return back();
    }
}
