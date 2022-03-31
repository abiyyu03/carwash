<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_Packet;

class ServicePacketController extends Controller
{
    function index()
    {
        return view('service_packet.index');
    }

    function store(Request $request)
    {
        //
    }
}
