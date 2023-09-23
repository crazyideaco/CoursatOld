@extends('App.dash')
@section('content')
<style>
	.dropdown-toggle{
      width: 100% !important;
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
                           <h5>دوره تعلميه شهريه</h5>

                        </div>
                            <form method="post" action="{{route('updatetype',$type->id)}}" enctype="multipart/form-data">
                        	@csrf
                                <div class="row">
                       <div class="col-md-6 col-12 text-center mb-5 set-img">
                       <video width="200" height="200" controls >
                          <source src="{{asset('uploads/'. $type->intro)}}" id="video_here">
                        Your browser does not support HTML5 video.
                      </video>
                      <br><br>
                               <input id="kt" type="file" class="form-control ehabtalaat" name="intro">
                                        <label for="kt" class="ahmed">اضافة انترو</label>
                                        @error('intro')
                                             <p style="color:red;">{{$message}}</p>
                                        @enderror
                                       </div>
                                   <div class="col-md-6 col-12 text-center set-img">
                                        <img src="{{asset('uploads/'. $type->image)}}" id="realimg">
                                   <br>
                               <input id="ad" type="file" class="form-control ehabtalaat" name="image">
                                        <label for="ad" class="ahmed">اضافة صوره</label>
                                        @error('image')
                                         <p style="color:red;">{{$message}}</p>
                                        @enderror
                           </div>
                                       </div>
                        	@if(Auth::user() && Auth::user()->isAdmin == 'admin')

                        <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الدوره بالعربى</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_ar" required value="{{$type->name_ar}}">
                            @error('name_ar')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الدوره بالانجليزي</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_en" required value="{{$type->name_en}}">
                            @error('name_en')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                         <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>المرحله</label>
                            <select class="form-control" name="stage_id" required onchange="getstage(this)">
                                 <option value="0" selected="selected" disabled="disabled">ادخل المرحله</option>
                                @foreach($stages as $stage)
                                <option value='{{$stage->id}}' @if($type->stage_id == $stage->id) selected="selected" @endif>{{$stage->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('stage_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                       <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>سنه الماده</label>
                            <select class="form-control" name="years_id" id="year" required onchange="getyear(this)">
                                @foreach($years as $year)
                                <option value='{{$year->id}}' @if($type->years_id == $year->id )
                                selected @endif>{{$year->year_ar}}</option>
                                @endforeach
                            </select>
                                 @error('years_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>

                                <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>الماده </label>
                            <select class="form-control" name="subjects_id" required id="subject"  onchange="getteacher(this)">
                                @foreach($subjects as $subject)
                                <option value='{{$subject->id}}' @if($type->subjects_id == $subject->id )
                                selected @endif>{{$subject->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('subjects_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                                     <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم المدرس</label>
                      <select name="user_id" class="form-control" required id="teacher">
                          <option value="0" selected="selected" disabled>اختر المدرس</option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}" @if($type->user_id == $user->id) selected="selected" @endif>{{$user->name}}</option>
                          @endforeach
                      </select>
                            @error('user_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                                    <div class=" col-lg-3 col-md-6 col-12">
                                 <label>التاج </label>
                                <select class="form-control selectpicker"  data-live-search="true"  multiple name="tag_id[]">

                                  @foreach($tags as $tag)
                                  <option value="{{$tag->id}}" @if(in_array($tag->id,$type->tags->pluck('id')->toArray())) selected @endif>{{$tag->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-lg-3 col-md-6 col-12">
                               <label>عدد النقط</label>
                               <input  type="number" class="form-control" name="points" value="{{$type->points}}">
                               </div>
                                </div>
                            </div>
                          @elseif(Auth::user() && Auth::user()->is_student == 5 && Auth::user()->category_id == 1 )
                           <div class="info">
                            <div class="row">
                                <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الدوره بالعربى</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_ar" required value="{{$type->name_ar}}">
                            @error('name_ar')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                                 <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم الدوره بالانجليزي</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_en" required value="{{$type->name_en}}">
                            @error('name_en')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                         <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>المرحله</label>
                            <select class="form-control" name="stage_id" required onchange="getstage(this)">
                                 <option value="0" selected="selected" disabled="disabled">ادخل المرحله</option>
                                @foreach($stages as $stage)
                                <option value='{{$stage->id}}' @if($type->stage_id == $stage->id) selected="selected" @endif>{{$stage->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('stage_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                       <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>سنه الماده</label>
                            <select class="form-control" name="years_id" id="year" required onchange="getyear(this)">
                                @foreach($years as $year)
                                <option value='{{$year->id}}' @if($type->years_id == $year->id )
                                selected @endif>{{$year->year_ar}}</option>
                                @endforeach
                            </select>
                                 @error('years_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>

                                <div class="form-group col-lg-3 col-md-6 col-12">
                           <label>الماده </label>
                            <select class="form-control" name="subjects_id" required id="subject"  onchange="getteacher(this)">
                                @foreach($subjects as $subject)
                                <option value='{{$subject->id}}' @if($type->subjects_id == $subject->id )
                                selected @endif>{{$subject->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('subjects_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                                     <div class="form-group col-lg-3 col-md-6 col-12">
                                    <label>اسم المدرس</label>
                      <select name="user_id" class="form-control" required id="teacher">
                          <option value="0" selected="selected" disabled>اختر المدرس</option>
                          @foreach(auth()->user()->teachers as $user)
                          <option value="{{$user->id}}" @if($type->user_id == $user->id) selected="selected" @endif>{{$user->name}}</option>
                          @endforeach
                      </select>
                            @error('user_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                                <div class="col-lg-3 col-md-6 col-12">
                                 <label>التاج </label>
                                <select class="form-control selectpicker"  data-live-search="true"  multiple name="tag_id[]">

                                  @foreach($tags as $tag)
                                  <option value="{{$tag->id}}" @if(in_array($tag->id,$type->tags->pluck('id')->toArray())) selected @endif>{{$tag->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-lg-3 col-md-6 col-12">
                               <label>عدد النقط</label>
                               <input  type="number" class="form-control" name="points" value="{{$type->points}}">
                               </div>
                                </div>
                            </div>
                               @elseif(Auth::user() && Auth::user()->is_student == 2)
                                <div class="info">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label>اسم الدوره بالعربى</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_ar"  required value="{{$type->name_ar}}">
                            @error('name_ar')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                                 <div class="form-group col-3">
                                    <label>اسم الدوره بالانجليزي</label>
                    <input type="text" class="form-control"
                            placeholder="ادخل اسم " name="name_en" required value="{{$type->name_en}}">
                            @error('name_en')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                           </div>
                         <div class="form-group col-3">
                           <label>المرحله</label>
                            <select class="form-control" name="stage_id" required onchange="getstage(this)">
                                 <option value="0" selected="selected" disabled="disabled">ادخل المرحله</option>
                                @foreach($stages as $stage)
                                <option value='{{$stage->id}}' @if($type->stage_id == $stage->id) selected="selected" @endif>{{$stage->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('stage_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                       <div class="form-group col-3">
                           <label>سنه الماده</label>
                            <select class="form-control" name="years_id"required id="year" onchange="getyear(this)">
                                @foreach($years as $year)
                                <option value='{{$year->id}}' @if($type->years_id == $year->id )
                                selected @endif>{{$year->year_ar}}</option>
                                @endforeach
                            </select>
                                 @error('years_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>

                                <div class="form-group col-3">
                           <label>الماده </label>
                            <select class="form-control" name="subjects_id" required id="subject" >
                                @foreach($subjects as $subject)
                                <option value='{{$subject->id}}' @if($type->subjects_id == $subject->id )
                                selected @endif>{{$subject->name_ar}}</option>
                                @endforeach
                            </select>
                                 @error('subjects_id')
                           <p style="color:red;">{{$message}}</p>
                            @enderror
                             </div>
                                <div class="col-6">
                                 <label>التاج </label>
                                <select class="form-control selectpicker"  data-live-search="true"  multiple name="tag_id[]">

                                  @foreach($tags as $tag)
                                  <option value="{{$tag->id}}" @if(in_array($tag->id,$type->tags->pluck('id')->toArray())) selected @endif>{{$tag->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group col-3">
                               <label>عدد النقط</label>
                               <input  type="number" name="points" value="{{$type->points}}">
                               </div>
                                </div>
                            </div>
                               @endif
                               <div>
                                 <div class="form-group col-12">
                                   <label>الوصف </label>
                                   <textarea class="form-control" rows="5" name="description">{{$type->description}}</textarea>
                               </div>
                               </div>
                               <br><br>
                         <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow=""
                      aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                        0%
                      </div>
                    </div>
                    <br />
                    <div id="success">

                    </div>
                    <br />
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
   $('form').ajaxForm({
      beforeSend:function(){
        $('#success').empty();
      },
      uploadProgress:function(event, position, total, percentComplete)
      {
        $('.progress-bar').text(percentComplete + '%');
        $('.progress-bar').css('width', percentComplete + '%');
      },
      success:function(data)
      {
        if(data.errors)
        {
          $('.progress-bar').text('0%');
          $('.progress-bar').css('width', '0%');
          $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
        }
        if(data.success)
        {
          $('.progress-bar').text('Uploaded');
          $('.progress-bar').css('width', '100%');
          $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
         location.href ='../types';
        }
      }
    });
	function getstage(selected){
    let id = selected.value;
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getstage/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $('#year').empty();
    $('#year').html(result);

       }

      });
    }
    	function getyear(selected){
    let id = selected.value;
 $.ajaxSetup({
       headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
       type:"get",
       url: `../getyear/${id}`,
         contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
    $('#subject').empty();
    $('#subject').html(result);

       }

      });
    }
 function getteacher(selected){

var id = selected.value;
 console.log(id);
   $.ajax({
       type:"GET",
       url: `../getteacher/${id}`,//put y
      contentType: "application/json; charset=utf-8",
       dataType: "Json",
       success: function(result){
        $('#teacher').empty();
        $('#teacher').html(result[0]);
        $('#type').empty();
        $('#type').html(result[1]);

       }

      });
}
$(document).on("change", "#kt", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#realimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#ad").change(function(){
    readURL(this);
})
    </script>
  @endsection
