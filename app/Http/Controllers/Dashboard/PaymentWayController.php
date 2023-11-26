<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentWay;
use App\User;

use Illuminate\Support\Facades\Validator;

class PaymentWayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentWays =  PaymentWay::get();
        return view("dashboard.payment_wayes.index", compact("paymentWays"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $centers = User::where("is_student", 5)->get();
        return view("dashboard.payment_wayes.create", compact("centers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "string",
            "number" => "string",
            'image' => "nullable|image|mimes:png,jpg,jpeg",
        ]);

        $data['title'] =  $request->title;
        $data['number'] = $request->number;
        $data['creator_id'] = auth()->id();
        if ($request->image) {
            $image = $request->image;
            $image->move('uploads', time() . '.' . $image->getClientOriginalExtension());
            $data['image'] = time() . '.' . $image->getClientOriginalExtension();
        }
        $paymentway = PaymentWay::create($data);

        // if (auth()->user()->is_student == config('project_types.auth_user_is_student.center')) {
        //     $paymentway->update(['center_id' => auth()->id()]); // center_id = auth()->id();
        //     $paymentway->centers()->attach(auth()->id());
        // } else {
        //     $paymentway->centers()->attach($request->center_id);
        // }

        return redirect()->route("paymentways.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentway = PaymentWay::get()->where("id", $id);
        return view("dashboard.payment_wayes.show", $paymentway);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentway = PaymentWay::where("id", $id)->first();
        $centers = User::where("is_student", 5)->get();
        return view("dashboard.payment_wayes.edit", compact("paymentway", "centers"));
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
        $request->validate([
            "title" => "string",
            "number" => "string",
            'image' => "nullable|image|mimes:png,jpg,jpeg",
        ]);

        $paymentway =  paymentWay::find($id);



        $data['title'] =  $request->title;
        $data['number'] = $request->number;
        $data['creator_id'] = auth()->id();
        if ($request->image) {
            $image = $request->image;
            $image->move('uploads', time() . '.' . $image->getClientOriginalExtension());
            $data['image'] = time() . '.' . $image->getClientOriginalExtension();
        }
        // if (auth()->user()->is_student == config('project_types.auth_user_is_student.center')) {
        //     $data['center_id'] = auth()->id();
        //     // $paymentway->update(['center_id' => auth()->id()]);
        //     $paymentway->centers()->sync(auth()->id());
        // } else {
        //     $paymentway->centers()->sync($request->center_id);
        // }
        $paymentway->update($data);
        return redirect()->route("paymentways.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaymentWay::where("id", $id)->delete();
        return response()->json(['status' => true, 'message' => 'تم المسح بنجاح']);
    }
}
