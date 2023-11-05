@extends('App.dash')
@section('content')
<style>
	.setting .info button{
		width: 100% !important;
	}
	.bootstrap-select .dropdown-toggle .filter-option{
		text-align: start !important;
	}
</style>
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
                            <h5>اضافه ماده </h5>
                        </div>
                            <form method="post" action="{{route('storesubject')}}" enctype="multipart/form-data">
                        	@csrf
                          
                        <div class="row">
                            <div class="col-12 text-center set-img">
                               <img src="{{asset('images/set-img.svg')}}" id="realimg">
                                <br>
                               <input id="addtyps" type="file" class="form-control ehabtalaat" name="image">
                                        <label for="addtyps" class="ahmed">اضافة صوره</label>
                                        @error('image')
                                    <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>

                            </div>
                        <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الماده بالعربى</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " value="{{old('name_ar')}}" name="name_ar" >
                            @error('name_ar')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                            <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الماده بالانجليزي</label>
                    <input type="text" class="form-control" 
                            placeholder="ادخل اسم " value="{{old('name_en')}}" name="name_en">
                            @error('name_en')
                         <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                             <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>المرحله</label>
                            <select class="form-control selectpicker"  data-live-search="true" name="stage_id" onchange="getstage(this)">
                                 <option value="0" selected="selected"  disabled="disabled">ادخل المرحله</option>
                                @foreach($stages as $stage)
                                <option value='{{$stage->id}}' @if(old('stage_id') == $stage->id) selected @endif>{{$stage->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('years_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div> 
                       <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>سنه الماده</label>
                            <select class="form-control selectpicker" data-live-search="true" multiple="multiple" name="years_id[]" id="year" onchange="getsandl(this)">
                                <option value="0" selected="selected" disabled="disabled">ادخل السنه</option>
                                @foreach($years as $year)
                                <option value='{{$year->id}}' @if(old('years_id') == $year->id) selected @endif>{{$year->year_ar}}</option>
                                @endforeach
                            </select>
                                 @error('years_id')
                            <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div> 
                               <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>تخصص الماده</label>
                            <select class="form-control" name="sandl" id="sandl">
                                <option value="null" selected="seclected" disabled="disabled">ادخل التخصص</option>
                                <option value="0">بلاتخصص</option>
                                 <option value="1">علمى</option>
                                  <option value="2">ادبى</option>
                                   <option value="3">علمى و ادبى</option>
                            </select>
                                 @error('sandl')
                   <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div> 
                                   
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
	function getstage(selected){
    let id = selected.value;
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getstage/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $('#year').empty();
    $('#year').html(result);
		   $("#year").selectpicker("refresh");
        
       }

      });
    }
  function getsandl(selected){
      let id = selected.value;
      $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `getsandl/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
     $('#sandl').empty();
    $('#sandl').html(result);
       }

      });
  }

function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#addtyps").change(function(){
    readURL3(this);
});
</script>
  @endsection