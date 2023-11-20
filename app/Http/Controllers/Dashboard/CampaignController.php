<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignrequest;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campains = new Campaign;
        $campains->get();
        return view("",compact("campaigns"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignrequest $request)
    {
        $campain = new Campaign();
        $campain->title = $request->title;
        $campain->start_date = $request->start_date;
        $campain->end_date = $request -> end_date;
        $campain->description = $request->description;
        $campain->platform = $request->platform;
        $campain->save();
        return view("");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campain =  Campaign::where("id",$id)->get();
        return view("",$campain);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campain =  Campaign::where("id",$id)->get();
        return view("",$campain);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCampaignrequest $request, $id)
    {
        $campain =  Campaign::where("id",$id)->get();
        $campain->title = $request->title;
        $campain->start_date = $request->start_date;
        $campain->end_date = $request -> end_date;
        $campain->description = $request->description;
        $campain->platform = $request->platform;
        $campain->save();
        return view("");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campain =  Campaign::where("id",$id)->delete();
        return view("");
    }
}
