<?php

namespace App\Http\Controllers\Dashboard;

use App\College;
use App\DataTables\SystemSettings\CampainStudentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignrequest;
use App\Models\Campaign;
use App\Models\Platform;
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
        $campaigns =  Campaign::get();
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
        $platforms = Platform::get();
        $universities = University::get();

        return view("dashboard.Campaigns.create", compact("stages", "universities", "platforms"));
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
        $campain->category_id = $request->category_id;
        $campain->save();
        $campain->Platforms()->attach($request->platform);

        return redirect(route("campaigns.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CampainStudentDataTable $dataTable, $id)
    {
        $campain =  Campaign::where("id", $id)->get();
        return $dataTable->with("campain", $campain)->render("dashboard.Campaigns.show", compact("campain"));
        // return view("dashboard.Campaigns.show", $campain);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign =  Campaign::where("id", $id)->first();
        $stages = Stage::get();
        $universities = University::get();
        $platforms = Platform::get();
        return view("dashboard.Campaigns.edit", compact("stages", "universities", "campaign", 'platforms'));
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
        $campain->category_id = $request->category_id;
        $campain->save();
        $campain->Platforms()->sync($request->platform);

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
