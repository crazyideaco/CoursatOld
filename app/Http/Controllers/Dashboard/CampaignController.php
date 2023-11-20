<?php

namespace App\Http\Controllers\Dashboard;

use App\College;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignrequest;
use App\Models\Campaign;
use App\Stage;
use App\Subject;
use App\University;
use App\Year;
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
        return view("dashboard.Campaigns.index", compact("campaigns"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $stages = Stage::get();
        // $years = Year::get();
        // $subjects = Subject::get();

        // $colleges = College::get();
        $universities = University::get();
        // dd($stages);
        return view("dashboard.Campaigns.create", compact("stages", "universities"));

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
        $campain->end_date = $request->end_date;
        $campain->description = $request->description;
        $campain->platform = $request->platform;
        $campain->save();

        return redirect(route("campaigns.index"));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campain =  Campaign::where("id", $id)->get();
        return view("", $campain);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campain =  Campaign::where("id", $id)->get();
        $stages = Stage::get();
        // $years = Year::get();
        // $subjects = Subject::get();
        // $colleges = College::get();
        $universities = University::get();
        return view("dashboard.Campaigns.edit", compact("stages", "universities", "campaign"));

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
        $campain =  Campaign::where("id", $id)->get();
        $campain->title = $request->title;
        $campain->start_date = $request->start_date;
        $campain->end_date = $request->end_date;
        $campain->description = $request->description;
        $campain->platform = $request->platform;
        $campain->save();
        return redirect(route("campaigns.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Campaign::where("id", $id)->delete();
        return view("dashboard.Campaigns.index");

    }
}