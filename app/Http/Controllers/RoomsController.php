<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Reservasi;


class RoomsController extends Controller
{
    public function SuperiorRoom()
    {
        return view('Rooms.SuperiorRoom');
    }

    public function DeluxRoom()
    {
        
        return view('Rooms.DeluxRoom');
    }

    public function VIPDelux()
    {
        
        return view('Rooms.VIPDelux');
    }

    public function FamilySuite()
    {
        
        return view('Rooms.FamilySuite');
    }

    public function ExecutiveSuite()
    {
        
        return view('Rooms.ExecutiveSuite');
    }
}
