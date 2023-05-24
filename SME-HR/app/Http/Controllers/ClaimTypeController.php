<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClaimTypeRecord;
use Illuminate\Http\Request;

class ClaimTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ListClaimType()
    {
        $listClaimType = ClaimTypeRecord::all();
        return view('ManageClaim.ListClaimType', ["listClaimType" => $listClaimType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addClaimType()
    {
        return view('ManageClaim.AddClaimType');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function StoreClaimType(Request $request)
    {
        //store a new user (staff)
        $newClaimType = ClaimTypeRecord::create([
            'name' => $request['name'],
        ]);

        return redirect()->route('ListClaimType');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
