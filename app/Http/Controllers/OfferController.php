<?php
namespace App\Http\Controllers;

use App\Category;
use App\Offer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:offers-create'])->only('addoffer');
        $this->middleware(['permission:offers-read'])->only('offers');
        $this->middleware(['permission:offers-update'])->only('editoffer');
        $this->middleware(['permission:offers-delete'])->only('deleteoffer');
    }
    public function offers()
    {
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $offers = Offer::where('center_id', null)->get();
        } elseif (Auth::user() && Auth::user()->is_student == 5) {
            $offers = Offer::where('center_id', auth()->id())->get();
        }
        return view('dashboard.offers')->with('offers', $offers);
    }
    public function addoffer()
    {
        $categories = Category::get();
        return view('dashboard.addoffer',compact("categories"));
    }
    public function storeoffer(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ], [
            'required' => 'حقل الصوره مطلوب',
            'mimes' => 'الحقل يجب ان يكون صوره',
        ]);
        $offer = new Offer;
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->move('uploads', time() . $image->getClientOriginalName());
            $offer->image = time() . $request->image->getClientOriginalName();
        }
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $offer->category_id = $request->category_id;

        } elseif (Auth::user() && Auth::user()->is_student == 5) {
            $offer->center_id = auth()->id();
        }
        $offer->link = $request->link;

        $offer->save();
        return redirect()->route('offers');
    }public function editoffer($id)
    {
        $offer = Offer::where('id', $id)->first();
        $categories = Category::get();
        return view('dashboard.editoffer',compact("categories","offer"));
    }
    public function updateoffer($id, Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png,gif',
        ], [
            'mimes' => 'الحقل يجب ان يكون صوره',
        ]);
        $offer = Offer::where('id', $id)->first();
        if (auth()->user() && auth()->user()->isAdmin == 'admin') {
            $offer->category_id = $request->category_id;

        } elseif (Auth::user() && Auth::user()->is_student == 5) {
            $offer->center_id = auth()->id();
        }
        if ($request->hasFile('image')) {
            if (public_path() . '/uploads/' . $offer->image) {
                $link = public_path() . '/uploads/' . $offer->image;
                File::delete($link);
            }
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
            $offer->image = $request->image->getClientOriginalName();
        }
        $offer->link = $request->link;
        $offer->save();
        return redirect()->route('offers');
    }

    public function deleteoffer($id)
    {
        $offer = Offer::find($id);
        if (public_path() . '/uploads/' . $offer->image) {
            $link = public_path() . '/uploads/' . $offer->image;
            File::delete($link);
        }
        $offer->delete();
        return response()->json(['status' => true]);
    }
}
