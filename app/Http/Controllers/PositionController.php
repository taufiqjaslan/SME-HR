<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PositionRecord;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListPosition()
    {
        $listPosition = PositionRecord::all();
        return view('ManageEmployee.ListPosition', ["listPosition" => $listPosition]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addPosition()
    {
        return view('ManageEmployee.AddPosition');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StorePosition(Request $request)
    {
        //store a new user (staff)
        $newPosition = PositionRecord::create([
            'position_name' => $request['position_name'],
        ]);

        return redirect()->route('ListPosition');
    }

}
