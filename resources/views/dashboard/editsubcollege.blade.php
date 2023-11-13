@extends('App.dash')
@section('content')
  <!--start page-body-->
        <div class="page-body">
            <div class="container">

                <!--start heed-->
                           <div class="heed">

                    <div class="row">
                <div class="profile">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{asset('images/profile.svg')}}">
                        </div>
                        <div class="col-6">
                            <h5>{{auth()->user()->name}}</h5>
                            <p>ادمن</p>

                        </div>

            
                            </div>
                        </div>
                        <div class="flag">

                            <div class="row">
                                <div class="col-4">
                                    <img src="{{asset('images/flag.svg')}}">
                                </div>
                                <div class="col-4">
                                    <h5>العربية</h5>


                                </div>

                         

                            </div>

                        </div>


                        <div class="noti text-center">
                            <span><i class="far fa-bell"></i></span>
                        </div>



                        <div class="search">

                            <input type="text" name="search">
                            <span class="srch"><i class="fas fa-search"></i></span>

                        </div>

                        <div class="datee">
                            <div class="row">
                                <span><i class="far fa-calendar-alt"></i></span>
                                <p>{{ Carbon\Carbon::now()->format('d-m-Y')}}</p>
                            </div>
                        </div>


                    </div>


                </div>
                <!--end heed-->


                <!--start setting-->
                <div class="setting">
                    <div class="container">
                        <div class="row def">
                            <img src="{{asset('images/setting.svg')}}">
                            <h5>تعديل ماده </h5>
                        </div>
                            <form method="post" action="{{route('updatesubcollege',$subcollege)}}" enctype="multipart/form-data">
                        	@csrf
                         
                                    
                               
                       
                        <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                 <label>اسم الماده بالعربى</label>
                                    <input class="form-control" type="text" name="name_ar" value="{{$subcollege->name_ar}}">
									    @error('name_ar')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                 <label>اسم الماده بالانجليزي</label>
                                    <input class="form-control" type="text" name="name_en" value="{{$subcollege->name_en}}">
									    @error('name_en')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                                    <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الجامعه </label>
                                   <select name="university_id" class="form-control" onchange="getcolleges(this)">
                                       <option value="0" disabled="disabled" selected="selected">اختر جامعه</option>
                                       @foreach($universities as $university)
                                       <option value="{{$university->id}}"
                                       @if($subcollege->university_id == $university->id) 
                                       selected @endif>
                                           {{$university->name_ar}}
                                           </option>
                                       @endforeach
                                   </select>
                                    @error('university_id')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الكليه </label>
                                   <select name="college_id" class="form-control" id="college" onchange="getdivision(this)">
                                       <option value="0" disabled="disabled" selected="selected">اختر كليه</option>
                                       @foreach($colleges as $college)
                                       <option value="{{$college->id}}" @if($subcollege->college_id 
                                       == $college->id) selected @endif>{{$college->name_ar}}</option>
                                       @endforeach
                                   </select>
									     @error('college_id')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم القسم </label>
                                   <select name="division_id" class="form-control" id="division" onchange="getsection(this)">
                                       <option value="0" disabled="disabled" selected="selected">اختر فرقه</option>
                                       @foreach($divisions as $division)
                                       <option value="{{$division->id}}" @if($subcollege->division_id 
                                       == $division->id) selected @endif>{{$division->name_ar}}</option>
                                       @endforeach
                                   </select>
									     @error('division_id')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الفرقه </label>
                                   <select name="section_id" class="form-control" id="section" >
                                       <option value="0" disabled="disabled" selected="selected">اختر قسم</option>
                                       @foreach($sections as $section)
                                       <option value="{{$section->id}}" @if($subcollege->section_id 
                                       == $section->id) selected @endif>{{$section->name_ar}}</option>
                                       @endforeach
                                   </select>
									    @error('section_id')
                                    <p style="color:red;">{{$message}}</p>
                                    @enderror
                                </div>
                               
                            </div>
                         
                        <div class="save text-center mt-6">
                            <div class="row save">
                                <div class="col-12 text-center">
                                  <input type="submit" value="حفظ" class="text-center">

                                </div>

                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

            <!--end setting-->
            <!--start foter-->
            <div class="foter">
                <div class="row">
                    <div class="col-12 text-center">
                        <h5>Made With <img src="{{asset('images/red.svg')}}"> By Crazy Idea </h5>
                        <p>Think Out Of The Box</p>
                    </div>
                </div>
            </div>
            <!--end foter-->
        </div>
    </div>
    <!--end page-body-->

@endsection
@section("scripts")
<script>
    function getdivision(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getdivision/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#division').empty();
    $('#division').html(result);
       }

      });
  }
  function getsection(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getsection/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#section').empty();
    $('#section').html(result);
       }

      });
  }function getcolleges(selected){
let id = selected.value;
console.log(id);
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getcolleges/${id}`,
   //    contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
       $('#college').empty();
       $('#college').html(result.data);
       console.log(result);
       }

      });
    }
</script>
@endsection