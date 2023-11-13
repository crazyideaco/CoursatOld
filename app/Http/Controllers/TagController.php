<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Tag;

class TagController extends Controller
{
      public function __construct()
    {
    //   $this->middleware(['permission:stages-create'])->only('addstage');
    //    $this->middleware(['permission:stages-read'])->only('stages');
     //   $this->middleware(['permission:stages-update'])->only('editstage');
      // $this->middleware(['permission:stages-delete'])->only('deletestage');
    }
   public function create(){
        return view('dashboard.tags.create');
    }
      public function store(Request $request){
     
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index');
    } public function edit($id){
        return view('dashboard.tags.edit')->with('tag',Tag::where('id',$id)->first());
    }
      public function update($id,Request $request){
        
        $tag = Tag::where('id',$id)->first();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index');
    }
    public function index(){
        return view('dashboard.tags.index')->with('tags',Tag::all());
    }public function destroy($id){
  $tag = Tag::where('id',$id)->first();
  $tag->delete();
  return response()->json(['status' => true]);
}  
}