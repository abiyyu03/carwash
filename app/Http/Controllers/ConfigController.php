<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\User;

class ConfigController extends Controller
{
    function index()
    {
        return view('config.index');
    }

    function update(Request $request, $id_user)
    {
        $user_data = User::find($id_user);
        $user_data->name = $request->name;
        $user_data->password = bcrypt($request->password);
        $user_data->save();

        Alert::success('Sukses','Profil mu berhasil diubah !');
        return back();
    }
}
